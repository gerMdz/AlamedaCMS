<?php

namespace App\Action\Reservante;

use App\Entity\Reservante;
use App\Service\Handler\Celebracion\HandlerCelebracion;
use App\Service\Handler\Reservante\HandlerReservante;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Request;

class AddReservation
{
    private $handlerCelebracion;
    private $handlerReservante;

    /**
     * @param HandlerCelebracion $handlerCelebracion
     * @param HandlerReservante $handlerReservante
     */
    public function __construct(HandlerCelebracion $handlerCelebracion, HandlerReservante $handlerReservante)
    {
        $this->handlerCelebracion = $handlerCelebracion;
        $this->handlerReservante = $handlerReservante;
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Reservante|void
     */
    public function __invoke(Request $request, string $id)
    {
        $celebracion = $this->handlerCelebracion->existeCelebracion($id);

        try {
            return $this->handlerReservante->saveReservante($celebracion, json_decode($request->getContent()));
        } catch (OptimisticLockException | ORMException $e) {
        }

    }
}