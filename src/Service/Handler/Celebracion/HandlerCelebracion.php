<?php

namespace App\Service\Handler\Celebracion;

use App\Entity\Celebracion;
use App\Entity\Invitado;
use App\Entity\WaitingList;
use App\Repository\CelebracionRepository;
use App\Repository\InvitadoRepository;
use Doctrine\Common\Collections\Collection;

class HandlerCelebracion
{
    private $invitadoRepository;
    private $celebracionRepository;

    /**
     * HandlerCelebracion constructor.
     */
    public function __construct(InvitadoRepository $invitadoRepository, CelebracionRepository $celebracionRepository)
    {
        $this->invitadoRepository = $invitadoRepository;
        $this->celebracionRepository = $celebracionRepository;
    }

    public function hayLugar(Celebracion $celebracion): bool
    {
        $ocupadas = $this->invitadoRepository->countByCelebracion($celebracion->getId());
        $lugares = $celebracion->getCapacidad();

        return $lugares > $ocupadas;
    }

    /**
     * @return WaitingList[]|Collection
     */
    public function theWaitingList(Celebracion $celebracion)
    {
        return $celebracion->getWaitingLists();
    }

    /**
     * @return Invitado[]|Collection
     */
    public function theInvitadosList(Celebracion $celebracion)
    {
        return $celebracion->getInvitados();
    }

    public function theInvitadosEmail(Celebracion $celebracion): array
    {
        $invitados = [];

        foreach ($celebracion->getInvitados() as $invitado) {
            array_push($invitado, $invitado->getEmail());
        }

        return $invitados;
    }
}
