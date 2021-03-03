<?php


namespace App\Service\Handler\Celebracion;


use App\Entity\Celebracion;
use App\Repository\CelebracionRepository;
use App\Repository\InvitadoRepository;

class HandlerCelebracion
{
    private $invitadoRepository;

    /**
     * HandlerCelebracion constructor.
     * @param InvitadoRepository $invitadoRepository
     */
    public function __construct(InvitadoRepository $invitadoRepository)
{
    $this->invitadoRepository = $invitadoRepository;
}

    /**
     * @param Celebracion $celebracion
     * @return bool
     */
    public function hayLugar(Celebracion $celebracion): bool
    {
       $ocupadas = $this->invitadoRepository->countByCelebracion($celebracion->getId());
       $lugares = $celebracion->getCapacidad();
       return $lugares > $ocupadas;
    }

    /**
     * @param Celebracion $celebracion
     * @return bool
     */
    public function theWaitingList(Celebracion $celebracion): bool
    {
       $esperan = $celebracion->getWaitingLists();
       dd($esperan);
       return $esperan;
    }

}