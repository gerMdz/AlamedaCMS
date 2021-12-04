<?php

namespace App\Action\Reservante;

use App\Service\Handler\Celebracion\HandlerCelebracion;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AddReservation
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
        dd($request->getContent());
        return new JsonResponse($this->handlerCelebracion->reservasDisponibles());
    }
}