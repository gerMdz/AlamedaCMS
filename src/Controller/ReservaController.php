<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Entity\Invitado;
use App\Entity\Reservante;
use App\Form\ReservanteType;
use App\Repository\CelebracionRepository;
use App\Repository\ReservanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function creaReserva(Celebracion $celebracion, Request $request, EntityManagerInterface $em): Response
    {
        $reservante = new Reservante();
        $reservante->setCelebracion($celebracion);
        $form = $this->createForm(ReservanteType::class, $reservante, [
            'attr'=>['id'=>'formReserva']
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $reservado = $em->getRepository(Reservante::class)->findOneByReserva($celebracion->getId(), $reservante->getEmail());

            if ($reservado){
                $this->addFlash('success', 'Ya se encuentra una reservación para esta celebracion y con ese mail');
                return $this->redirectToRoute('reserva_index');
            }

            $em->persist($reservante);


            $invitado = new Invitado();
            $invitado->setCelebracion($celebracion);
            $invitado->setEnlace($reservante);
            $invitado->setApellido($reservante->getApellido());
            $invitado->setNombre($reservante->getNombre());
            $invitado->setEmail($reservante->getEmail());
            $invitado->setDni($reservante->getDocumento());
            $invitado->setTelefono($reservante->getTelefono());
            $em->persist($invitado);


            $invitados = $form['acompanantes']->getData();
            if ($invitados > 0) {
                for ($i = 0; $i < $invitados; $i++) {
                    $invitadoplus = new Invitado();
                    $invitadoplus->setCelebracion($celebracion);
                    $invitadoplus->setEnlace($reservante);
                    $em->persist($invitadoplus);

                }
            }
            $em->flush();

//            $this->addFlash('success', 'Se ha guardado su reserva');
            return $this->redirectToRoute('envia_mail', [
                'id' => $reservante->getId()
            ]);

        }

        return $this->render('reserva/vistaCreaReserva.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @Route("/vistaReserva/{celebracion}/{email}", name="vista_reserva")
     * @param EntityManagerInterface $em
     * @param ReservanteRepository $reservanteRepository
     * @param string $celebracion
     * @param string $email
     * @return Response
     */
    public function vistaReserva(EntityManagerInterface $em, ReservanteRepository $reservanteRepository, string $celebracion, string $email): Response
    {
        $reservante = $reservanteRepository->findOneByReserva($celebracion, $email);
        return $this->render('reserva/reservante.html.twig', [
            'reservante' => $reservante
        ]);
    }



}
