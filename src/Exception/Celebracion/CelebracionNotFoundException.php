<?php

namespace App\Exception\Celebracion;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CelebracionNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'No se encontró la celebración con id %s';

    public static function fromId(string $id): self
    {
        throw new self(\sprintf(self::MESSAGE, $id));
    }
}