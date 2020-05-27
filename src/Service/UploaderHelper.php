<?php


namespace App\Service;


use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploaderHelper
{
    const IMAGE_ENTRADA = 'image_entrada';
    private $uploadsPath;
    private $context;

    /**
     * UploaderHelper constructor.
     * @param string $uploadsPath
     * @param RequestStackContext $context
     */
    public function __construct(string $uploadsPath, RequestStackContext $context)
    {
        $this->uploadsPath = $uploadsPath;
        $this->context = $context;
    }

    public function uploadEntradaImage(UploadedFile $uploadedFile):string {
        $destination = $this->uploadsPath.'/'.self::IMAGE_ENTRADA;
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename =  Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );
        return $newFilename;
    }

    public function getPublicPath(string $path): string
    {
        return $this->context->getBasePath(). '/uploads/'.$path;
    }

}