<?php

namespace App\Service;

use Exception;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FileNotFoundException;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Psr\Log\LoggerInterface;

class UploaderHelper
{
    const IMAGE_ENTRADA = 'image_entrada';
    const ENTRADA_REFERENCE = 'entrada_reference';

    private $context;
    private $filesystem;
    private $uploadedAssetsBaseUrl;
    private $privateFilesystem;
    private $logger;

    /**
     * UploaderHelper constructor.
     * @param FilesystemInterface $publicUploadsFilesystem
     * @param RequestStackContext $context
     * @param string $uploadedAssetsBaseUrl
     * @param FilesystemInterface $privateUploadsFilesystem
     * @param LoggerInterface $logger
     */
    public function __construct(
        FilesystemInterface $publicUploadsFilesystem,
        RequestStackContext $context,
        string $uploadedAssetsBaseUrl,
        FilesystemInterface $privateUploadsFilesystem,
        LoggerInterface $logger
    )
    {
        $this->context = $context;
        $this->filesystem = $publicUploadsFilesystem;
        $this->uploadedAssetsBaseUrl = $uploadedAssetsBaseUrl;
        $this->privateFilesystem = $privateUploadsFilesystem;
        $this->logger = $logger;
    }

    public function uploadEntradaImage(File $file, ?string $existingFilename ): string
    {

        $newFilename = $this->uploadFile($file, self::IMAGE_ENTRADA, true);

        if ($existingFilename) {
            try {
                $result = $this->filesystem->delete(self::IMAGE_ENTRADA.'/'.$existingFilename);
                if ($result === false) {
                    throw new Exception(sprintf('No se pudo borrar la imagen anterior "%s"', $existingFilename));
                }
            } catch (FileNotFoundException $e) {
                $this->logger->alert(sprintf('No se pudo borrar "%s" imagen perdida', $existingFilename));
            }
        }
        return $newFilename;

    }

    public function uploadEntradaReference(File $file): string
    {
        return $this->uploadFile($file, self::ENTRADA_REFERENCE, false);
    }

    public function getPublicPath(string $path): string
    {
        // needed if you deploy under a subdirectory
        return $this->context
                ->getBasePath().$this->uploadedAssetsBaseUrl.'/'.$path;
    }

    private function uploadFile(File $file, string $directory, bool $isPublic)
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }
        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();
        $filesystem = $isPublic ? $this->filesystem : $this->privateFilesystem;
        $stream = fopen($file->getPathname(), 'r');
        $result = $filesystem->writeStream(
            $directory.'/'.$newFilename,
            $stream
        );
        if ($result === false) {
            throw new Exception(sprintf('No se pudo escribir el archivo cargado "%s"', $newFilename));
        }
        if (is_resource($stream)) {
            fclose($stream);
        }
        return $newFilename;
    }

}
