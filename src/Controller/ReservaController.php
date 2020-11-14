<?php

namespace App\Controller;

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
}
