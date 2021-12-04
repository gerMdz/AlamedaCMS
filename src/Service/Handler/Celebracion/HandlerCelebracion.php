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
     * @param InvitadoRepository $invitadoRepository
     * @param CelebracionRepository $celebracionRepository
     */
    public function __construct(InvitadoRepository $invitadoRepository, CelebracionRepository $celebracionRepository)
{
    $this->invitadoRepository = $invitadoRepository;
    $this->celebracionRepository = $celebracionRepository;
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
     * @return WaitingList[]|Collection
     */
    public function theWaitingList(Celebracion $celebracion)
    {
        return $celebracion->getWaitingLists();
    }

    /**
     * @param Celebracion $celebracion
     * @return Invitado[]|Collection
     */
    public function theInvitadosList(Celebracion $celebracion)
    {
        return $celebracion->getInvitados();
    }

    /**
     * @param Celebracion $celebracion
     * @return array
     */
    public function theInvitadosEmail(Celebracion $celebracion): array
    {
        $invitados = [];

        foreach($celebracion->getInvitados() as $invitado ){
            array_push($invitado, $invitado->getEmail());
        }
            return $invitados;

    }


    /**
     * @return array
     */
    public function puedeHacerReserva(): array
    {
         return $this->celebracionRepository->puedeMostrarse()->getQuery()->getArrayResult();

    }



}