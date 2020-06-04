<?php


namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    const IMAGE_ENTRADA = 'image_entrada';

    private $context;
    private $filesystem;

    /**
     * UploaderHelper constructor.
     * @param FilesystemInterface $publicUploadsFilesystem
     * @param RequestStackContext $context
     */
    public function __construct(FilesystemInterface $publicUploadsFilesystem, RequestStackContext $context)
    {
        $this->context = $context;
        $this->filesystem = $publicUploadsFilesystem;
    }

    public function uploadEntradaImage(File $file):string
    {
        if ($file instanceof UploadedFile) {
            $originalFilename = $file->getClientOriginalName();
        } else {
            $originalFilename = $file->getFilename();
        }
        $newFilename = Urlizer::urlize(pathinfo($originalFilename, PATHINFO_FILENAME)).'-'.uniqid().'.'.$file->guessExtension();

        $this->filesystem->write(
            self::IMAGE_ENTRADA.'/'.$newFilename,
            file_get_contents($file->getPathname())
        );
        return $newFilename;
    }

    public function getPublicPath(string $path): string
    {
        return $this->context->getBasePath(). '/uploads/'.$path;
    }
}
