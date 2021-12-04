<?php

namespace App\Action\Celebracion;

use App\Service\Handler\Celebracion\HandlerCelebracion;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetCelebraciones
{

    private $handlerCelebracion;

    /**
     * @param HandlerCelebracion $handlerCelebracion
     */
    public function __construct(HandlerCelebracion $handlerCelebracion)
    {

        $this->handlerCelebracion = $handlerCelebracion;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse($this->handlerCelebracion->puedeHacerReserva());
    }
}