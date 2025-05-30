<?php

namespace App\Service;

use App\Helper\LoggerTrait;
use App\Service\ErrorHandler;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\Filesystem;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    use LoggerTrait;

    final public const IMAGE_ENTRADA = 'image_entrada';
    final public const ENTRADA_REFERENCE = 'entrada_reference';

    // Límites para validación de archivos
    final public const MAX_FILE_SIZE = 5 * 1024 * 1024; // 5MB en bytes
    final public const MAX_FILENAME_LENGTH = 100; // Máximo de caracteres para el nombre del archivo

    /**
     * UploaderHelper constructor.
     */
    public function __construct(
        private readonly Filesystem $filesystem, 
        private readonly RequestStackContext $context,
        private readonly string $uploadedAssetsBaseUrl, 
        private readonly Filesystem $privateFilesystem,
        private readonly ErrorHandler $errorHandler
    ) {
    }

    public function uploadEntradaImage(File $file, ?string $existingFilename): string
    {
        $this->logInfo('Iniciando carga de imagen de entrada', [
            'filename' => $file instanceof UploadedFile ? $file->getClientOriginalName() : $file->getFilename(),
            'existingFilename' => $existingFilename
        ]);

        $newFilename = $this->uploadFile($file, self::IMAGE_ENTRADA, true);

        if ($existingFilename) {
            try {
                $result = $this->filesystem->delete(self::IMAGE_ENTRADA . '/' . $existingFilename);
                if (false === $result) {
                    $errorMsg = sprintf('No se pudo borrar la imagen anterior "%s"', $existingFilename);
                    $this->logError($errorMsg, [
                        'directory' => self::IMAGE_ENTRADA,
                        'filename' => $existingFilename
                    ]);
                    throw new \Exception($errorMsg);
                }
                $this->logInfo('Imagen anterior eliminada correctamente', [
                    'directory' => self::IMAGE_ENTRADA,
                    'filename' => $existingFilename
                ]);
            } catch (FileNotFoundException) {
                $this->logAlert(sprintf('No se pudo borrar "%s" imagen perdida', $existingFilename), [
                    'directory' => self::IMAGE_ENTRADA,
                    'filename' => $existingFilename
                ]);
            }
        }

        $this->logInfo('Imagen de entrada cargada exitosamente', [
            'directory' => self::IMAGE_ENTRADA,
            'newFilename' => $newFilename
        ]);
        return $newFilename;
    }

    public function uploadEntradaReference(File $file): string
    {
        $this->logInfo('Iniciando carga de referencia de entrada', [
            'filename' => $file instanceof UploadedFile ? $file->getClientOriginalName() : $file->getFilename()
        ]);

        $newFilename = $this->uploadFile($file, self::ENTRADA_REFERENCE, false);

        $this->logInfo('Referencia de entrada cargada exitosamente', [
            'directory' => self::ENTRADA_REFERENCE,
            'newFilename' => $newFilename
        ]);

        return $newFilename;
    }

    public function getPublicPath(string $path): string
    {
        // needed if you deploy under a subdirectory
        return $this->context
                ->getBasePath() . $this->uploadedAssetsBaseUrl . '/' . $path;
    }

    private function uploadFile(File $file, string $directory, bool $isPublic)
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }

        $this->logDebug('Procesando archivo para carga', [
            'originalFilename' => $originalFilename,
            'directory' => $directory,
            'isPublic' => $isPublic ? 'true' : 'false'
        ]);

        // Validar tamaño del archivo
        if ($file->getSize() > self::MAX_FILE_SIZE) {
            $maxSizeMB = self::MAX_FILE_SIZE / (1024 * 1024);
            $errorMsg = $this->errorHandler->manejarErrorArchivoTamano(
                "{$maxSizeMB}MB",
                [
                    'filename' => $originalFilename,
                    'size' => $file->getSize(),
                    'maxSize' => self::MAX_FILE_SIZE
                ]
            );
            throw new \Exception($errorMsg);
        }

        // Validar longitud del nombre del archivo
        if (strlen($originalFilename) > self::MAX_FILENAME_LENGTH) {
            $errorMsg = $this->errorHandler->manejarErrorArchivoNombre(
                (string)self::MAX_FILENAME_LENGTH,
                [
                    'filename' => $originalFilename,
                    'length' => strlen($originalFilename),
                    'maxLength' => self::MAX_FILENAME_LENGTH
                ]
            );
            throw new \Exception($errorMsg);
        }

        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $file->guessExtension();

        $filesystem = $isPublic ? $this->filesystem : $this->privateFilesystem;

        try {
            $stream = fopen($file->getPathname(), 'r');
            if ($stream === false) {
                $errorMsg = sprintf('No se pudo abrir el archivo "%s" para lectura', $originalFilename);
                $this->logError($errorMsg, [
                    'path' => $file->getPathname()
                ]);
                throw new \Exception($errorMsg);
            }

            $result = $filesystem->writeStream(
                $directory . '/' . $newFilename,
                $stream
            );

            if (false === $result) {
                $errorMsg = sprintf('No se pudo escribir el archivo cargado "%s"', $newFilename);
                $this->logError($errorMsg, [
                    'directory' => $directory,
                    'newFilename' => $newFilename
                ]);
                throw new \Exception($errorMsg);
            }

            if (is_resource($stream)) {
                fclose($stream);
            }

            $this->logDebug('Archivo cargado exitosamente', [
                'directory' => $directory,
                'newFilename' => $newFilename,
                'originalFilename' => $originalFilename
            ]);

            return $newFilename;
        } catch (\Exception $e) {
            $this->logError('Error al cargar archivo', [
                'message' => $e->getMessage(),
                'originalFilename' => $originalFilename,
                'directory' => $directory
            ]);
            throw $e;
        }
    }

    public function readStream(string $path, bool $isPublic)
    {
        $this->logDebug('Intentando leer stream de archivo', [
            'path' => $path,
            'isPublic' => $isPublic ? 'true' : 'false'
        ]);

        $filesystem = $isPublic ? $this->filesystem : $this->privateFilesystem;

        try {
            $resource = $filesystem->readStream($path);

            if (false === $resource) {
                $errorMsg = sprintf('Error al abrir secuencia para "%s"', $path);
                $this->logError($errorMsg, [
                    'path' => $path,
                    'isPublic' => $isPublic ? 'true' : 'false'
                ]);
                throw new \Exception($errorMsg);
            }

            $this->logDebug('Stream de archivo leído exitosamente', [
                'path' => $path
            ]);

            return $resource;
        } catch (\Exception $e) {
            $this->logError('Error al leer stream de archivo', [
                'message' => $e->getMessage(),
                'path' => $path,
                'isPublic' => $isPublic ? 'true' : 'false'
            ]);
            throw $e;
        }
    }

    public function deleteFile(string $path, bool $isPublic)
    {
        $this->logInfo('Intentando eliminar archivo', [
            'path' => $path,
            'isPublic' => $isPublic ? 'true' : 'false'
        ]);

        $filesystem = $isPublic ? $this->filesystem : $this->privateFilesystem;

        try {
            $result = $filesystem->delete($path);

            if (false === $result) {
                $errorMsg = sprintf('Error borrando "%s"', $path);
                $this->logError($errorMsg, [
                    'path' => $path,
                    'isPublic' => $isPublic ? 'true' : 'false'
                ]);
                throw new \Exception($errorMsg);
            }

            $this->logInfo('Archivo eliminado exitosamente', [
                'path' => $path
            ]);
        } catch (\Exception $e) {
            $this->logError('Error al eliminar archivo', [
                'message' => $e->getMessage(),
                'path' => $path,
                'isPublic' => $isPublic ? 'true' : 'false'
            ]);
            throw $e;
        }
    }
}
