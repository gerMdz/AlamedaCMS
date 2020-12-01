<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Entity\Invitado;
use App\Entity\Reservante;
use App\Form\Filter\ReservaByEmailFilterType;
use App\Form\InvitadoType;
use App\Form\ReservanteType;
use App\Repository\CelebracionRepository;
use App\Repository\InvitadoRepository;
use App\Repository\ReservanteRepository;
use App\Service\Mailer;
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
     * @param Mailer $mailer
     * @return Response
     */
    public function creaReserva(Celebracion $celebracion, Request $request, EntityManagerInterface $em, Mailer $mailer): Response
    {
        $reservante = new Reservante();
        $reservante->setCelebracion($celebracion);
        $form = $this->createForm(ReservanteType::class, $reservante, [
            'attr' => ['id' => 'formReserva']
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $reservado = $em->getRepository(Reservante::class)->findOneByReserva($celebracion->getId(), $reservante->getEmail());

            if ($reservado) {
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
            $invitado->setIsEnlace(true);
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

            $mailer->sendReservaMessage($reservante);

//            return $this->redirectToRoute('envia_mail', [
//                'id' => $reservante->getId()
//            ]);

            $this->addFlash('success', 'Se ha guardado su reserva');
            return $this->redirectToRoute('vista_reserva', [
                'celebracion' => $reservante->getCelebracion()->getId(),
                'email' => $reservante->getEmail()
            ]);

        }

        return $this->render('reserva/vistaCreaReserva.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);

    }


    /**
     * @Route("/agregaInvitado/{id}", name="agrega_invitado", methods={"GET", "POST"})
     * @param Reservante $reservante
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function agregaInvitado(Reservante $reservante, Request $request, EntityManagerInterface $em): Response
    {
        $invitado = new Invitado();
        $invitado->setCelebracion($reservante->getCelebracion());
        $invitado->setEnlace($reservante);
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($invitado);
            $entityManager->flush();

            return $this->redirectToRoute('vista_reserva', [
                'celebracion' => $invitado->getCelebracion()->getId(),
                'email' => $invitado->getEnlace()->getEmail()
            ]);
        }

        return $this->render('reserva/newInvitado.html.twig', [
            'invitado' => $invitado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/vistaReserva/{celebracion}/{email}/presente", name="vista_reserva_presente")
     * @Route("/vistaReserva/{celebracion}/{email}", name="vista_reserva")
     * @param ReservanteRepository $reservanteRepository
     * @param string $celebracion
     * @param string $email
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function vistaReserva(ReservanteRepository $reservanteRepository, string $celebracion, string $email, EntityManagerInterface $em): Response
    {
        $reservante = $reservanteRepository->findOneByReserva($celebracion, $email);
        if ($this->isGranted("ROLE_RESERVA")) {

            $invitados = $reservante->getInvitados();
            foreach ($invitados as $invitado) {
                if (null === $invitado->getIsPresente() ) {
                    $invitado->setIsPresente(true);
                }
                $em->persist($reservante);
            }
            $em->flush();
        }

        return $this->render('reserva/reservante.html.twig', [
            'reservante' => $reservante
        ]);
    }

    /**
     * @Route("/vistaReservaInvitado/{invitado}/{email}", name="vista_reserva_invitado")
     * @param InvitadoRepository $invitadoRepository
     * @param string $invitado
     * @param string $email
     * @return Response
     */
    public function vistaReservaInvitado(InvitadoRepository $invitadoRepository, string $invitado, string $email): Response
    {
        $invitado = $invitadoRepository->find($invitado);
        return $this->render('reserva/invitado.html.twig', [
            'invitado' => $invitado
        ]);
    }

    /**
     * @Route("/{id}/completa", name="invitado_completa", methods={"GET","POST"})
     * @param Request $request
     * @param Invitado $invitado
     * @param Mailer $mailer
     * @return Response
     */
    public function edit(Request $request, Invitado $invitado, Mailer $mailer): Response
    {
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            if ($invitado->getEmail() != null) {
                $mailer->sendReservaInvitadoMessage($invitado);
            }

            $this->addFlash('success', 'Se ha guardado el cambio');
            return $this->redirectToRoute('vista_reserva', [
                'celebracion' => $invitado->getCelebracion()->getId(),
                'email' => $invitado->getEnlace()->getEmail()
            ]);
        }

        return $this->render('reserva/completaInvitado.html.twig', [
            'invitado' => $invitado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/completa_invitado", name="invitado_completa_self", methods={"GET","POST"})
     * @param Request $request
     * @param Invitado $invitado
     * @param Mailer $mailer
     * @return Response
     */
    public function editSelf(Request $request, Invitado $invitado, Mailer $mailer): Response
    {

        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $mailer->sendReservaInvitadoMessage($invitado);

            return $this->redirectToRoute('vista_reserva_invitado',
                [
                    'invitado' => $invitado->getId(),
                    'email' => $invitado->getEmail()
                ]);
        }

        return $this->render('reserva/completaInvitadoSelf.html.twig', [
            'invitado' => $invitado,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/consulta", name="reserva_consulta", methods={"GET","POST"})
     * @param Request $request
     * @param ReservanteRepository $reservanteRepository
     * @return Response
     */
    public function consultaReserva(Request $request, ReservanteRepository $reservanteRepository): Response
    {

        $form = $this->createForm(ReservaByEmailFilterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $celebracion = $form['celebracion']->getData();
            $email = $form['email']->getData();
            $reservante = $reservanteRepository->findOneByReserva($celebracion, $email);
            if (!$reservante) {
                $this->addFlash('info', 'No se encontró reserva');
                return $this->redirectToRoute('reserva_consulta');
            }

            return $this->redirectToRoute('vista_reserva',
                [
                    'celebracion' => $reservante->getCelebracion()->getId(),
                    'email' => $reservante->getEmail()
                ]);
        }

        return $this->render('reserva/consulta_reserva.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}", name="reserva_delete", methods={"DELETE"})
     * @param Request $request
     * @param Reservante $reservante
     * @return Response
     */
    public function delete(Request $request, Reservante $reservante): Response
    {
        if ($this->isCsrfTokenValid('delete' . $reservante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $invitados = $reservante->getInvitados();
            foreach ($invitados as $invitado) {
                $entityManager->remove($invitado);
            }

            $entityManager->remove($reservante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reserva_index');
    }


    /**
     * @Route("/cancela/{id}/invitado", name="cancela_invitado", methods={"GET"})
     * @param Request $request
     * @param Invitado $invitado
     * @return Response
     */
    public function cancelaReserva(Request $request, Invitado $invitado): Response
    {
        $celebracion = $invitado->getCelebracion()->getId();
        $email = $invitado->getEnlace()->getEmail();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($invitado);
        $entityManager->flush();
        $this->addFlash('success', 'Se canceló reserva.');
        return $this->redirectToRoute('vista_reserva',
            [
                'celebracion' => $celebracion,
                'email' => $email
            ]);
    }


}
