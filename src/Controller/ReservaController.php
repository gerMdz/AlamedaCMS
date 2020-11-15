<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Entity\Reservante;
use App\Form\ReservanteType;
use App\Repository\CelebracionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reserva")
 */
class ReservaController extends AbstractController
{
    /**
     * @Route("/ver", name="reserva_index")
     * @param CelebracionRepository $celebracionRepository
     * @return Response
     */
    public function index(CelebracionRepository $celebracionRepository): Response
    {
        return $this->render('reserva/index.html.twig', [
            'celebraciones' => $celebracionRepository->puedeMostrarse()->getQuery()->getResult()
        ]);
    }


    /**
     * @Route("creaReserva/{id}", name="crea_reserva" )
     * @param Celebracion $celebracion
     * @return Response
     */
    public function creaReserva(Celebracion $celebracion):Response
    {
        $reservante = new Reservante();
        $reservante->setCelebracion($celebracion);
        $form = $this->createForm(ReservanteType::class, $reservante);

        return $this->render('reserva/vistaCreaReserva.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);

    }


}
