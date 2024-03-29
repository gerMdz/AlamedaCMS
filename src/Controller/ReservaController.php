<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Entity\Invitado;
use App\Entity\Reservante;
use App\Entity\WaitingList;
use App\Event\ReservaEvent;
use App\Form\AvisoType;
use App\Form\Filter\ReservaByEmailFilterType;
use App\Form\InvitadoType;
use App\Form\ReservanteType;
use App\Repository\CelebracionRepository;
use App\Repository\GroupCelebrationRepository;
use App\Repository\InvitadoRepository;
use App\Repository\ReservanteRepository;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/reserva')]
class ReservaController extends AbstractController
{
    #[Route(path: '/ver', name: 'reserva_index')]
    public function index(CelebracionRepository $celebracionRepository, GroupCelebrationRepository $groupCelebrationRepository): Response
    {
        $grupos = $groupCelebrationRepository->puedeMostrarse()->getQuery()->getResult();
        if (!$grupos) {
            $grupos = null;
        }

        return $this->render('reserva/index.html.twig', [
            'celebraciones' => $celebracionRepository->puedeMostrarse()->getQuery()->getResult(),
            'grupos' => $grupos,
        ]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route(path: '/creaReserva/{id}', name: 'crea_reserva')]
    public function creaReserva(Celebracion $celebracion, Request $request, EntityManagerInterface $em, Mailer $mailer): Response
    {
        $reservante = new Reservante();
        $reservante->setCelebracion($celebracion);
        $form = $this->createForm(ReservanteType::class, $reservante, [
            'attr' => ['id' => 'formReserva'],
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
                for ($i = 0; $i < $invitados; ++$i) {
                    $invitadoplus = new Invitado();
                    $invitadoplus->setCelebracion($celebracion);
                    $invitadoplus->setEnlace($reservante);
                    $em->persist($invitadoplus);
                }
            }
            $em->flush();

            $repository = $em->getRepository(Invitado::class);
            $invitados = $repository->count(['enlace' => $reservante->getId()]);
            $mailer->sendReservaMessage($reservante, $invitados);

            $this->addFlash('success', 'Se ha guardado su reserva');

            $response = new Response();
            $response->headers->clearCookie('email');
            $response->headers->removeCookie('email');

            $time2 = $reservante->getCelebracion()->getFechaCelebracionAt()->getTimestamp();

            $nombre = 'email';
            $arrayDato = [
                $reservante->getEmail(),
            ];
            $arrayDatos = json_encode($arrayDato);

            $nombre2 = 'celebracion';
            $arrayDato2 = [
                $reservante->getCelebracion()->getFechaCelebracionAt(),
            ];
            $arrayDatos2 = json_encode($arrayDato2);

            $response->headers->setCookie(Cookie::create($nombre, $arrayDatos, $time2));
            $response->headers->setCookie(Cookie::create($nombre2, $arrayDatos2, $time2));
            $response->sendHeaders();

            return $this->redirectToRoute('vista_reserva', [
                'celebracion' => $reservante->getCelebracion()->getId(),
                'email' => $reservante->getEmail(),
            ]);
        }

        return $this->render('reserva/vistaCreaReserva.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form,
        ]);
    }

    #[Route(path: '/agregaInvitado/{id}', name: 'agrega_invitado', methods: ['GET', 'POST'])]
    public function agregaInvitado(Reservante $reservante, Request $request,
        EntityManagerInterface $entityManager): Response
    {
        $invitado = new Invitado();
        $invitado->setCelebracion($reservante->getCelebracion());
        $invitado->setEnlace($reservante);
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form['email']->getData();

            $invitado_existente = $entityManager->getRepository(Invitado::class)->findOneByCelebracionEmail($reservante->getCelebracion()->getId(), $email);

            if ($invitado_existente) {
                $this->addFlash('success', 'Ya se encuentra una reservación para esta celebracion y con ese mail');

                return $this->redirectToRoute('agrega_invitado', [
                    'id' => $reservante->getId(),
                ]);
            }

            $entityManager->persist($invitado);
            $entityManager->flush();

            return $this->redirectToRoute('vista_reserva', [
                'celebracion' => $invitado->getCelebracion()->getId(),
                'email' => $invitado->getEnlace()->getEmail(),
            ]);
        }

        return $this->render('reserva/newInvitado.html.twig', [
            'invitado' => $invitado,
            'form' => $form,
        ]);
    }

    #[Route(path: '/vistaReserva/{celebracion}/{email}', name: 'vista_reserva')]
    public function vistaReserva(ReservanteRepository $reservanteRepository, string $celebracion, string $email): Response
    {
        $reservante = $reservanteRepository->findOneByReserva($celebracion, $email);

        return $this->render('reserva/reservante.html.twig', [
            'reservante' => $reservante,
        ]);
    }

    #[Route(path: '/vistaReserva/{celebracion}/{email}/presente', name: 'vista_reserva_presente')]
    public function vistaReservaPresente(ReservanteRepository $reservanteRepository, string $celebracion, string $email, EntityManagerInterface $em): Response
    {
        if ($this->isGranted('ROLE_RESERVA')) {
            $reservante = $reservanteRepository->findOneByReserva($celebracion, $email);
            $invitados = $reservante->getInvitados();
            foreach ($invitados as $invitado) {
                if (null === $invitado->getIsPresente()) {
                    $invitado->setIsPresente(true);
                }
                $em->persist($reservante);
            }
            $em->flush();

            return $this->render('reserva/reservante.html.twig', [
                'reservante' => $reservante,
            ]);
        } else {
            return $this->redirectToRoute('admin');
        }
    }

    #[Route(path: '/vistaReservaInvitado/{invitado}/{email}', name: 'vista_reserva_invitado')]
    public function vistaReservaInvitado(InvitadoRepository $invitadoRepository, string $invitado): Response
    {
        $invitado = $invitadoRepository->find($invitado);

        return $this->render('reserva/invitado.html.twig', [
            'invitado' => $invitado,
        ]);
    }

    #[Route(path: '/{id}/completa', name: 'invitado_completa', methods: ['GET', 'POST'])]
    public function edit(Request $request, Invitado $invitado, Mailer $mailer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form['email']->getData();
            $existe = $entityManager->getRepository(Invitado::class)->findOneByCelebracionEmail($invitado->getCelebracion()->getId(), $email);
            if ($existe) {
                $this->addFlash('success', 'Ya se encuentra una reservación para esta celebracion y con ese mail');

                return $this->redirectToRoute('vista_reserva', [
                    'celebracion' => $invitado->getCelebracion()->getId(),
                    'email' => $invitado->getEnlace()->getEmail(),
                ]);
            }
            $entityManager->flush();

            if (null != $invitado->getEmail()) {
                $mailer->sendReservaInvitadoMessage($invitado);
            }

            $this->addFlash('success', 'Se ha guardado el cambio');

            return $this->redirectToRoute('vista_reserva', [
                'celebracion' => $invitado->getCelebracion()->getId(),
                'email' => $invitado->getEnlace()->getEmail(),
            ]);
        }

        return $this->render('reserva/completaInvitado.html.twig', [
            'invitado' => $invitado,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}/completa_invitado', name: 'invitado_completa_self', methods: ['GET', 'POST'])]
    public function editSelf(Request $request, Invitado $invitado, Mailer $mailer,
        EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $mailer->sendReservaInvitadoMessage($invitado);

            return $this->redirectToRoute('vista_reserva_invitado',
                [
                    'invitado' => $invitado->getId(),
                    'email' => $invitado->getEmail(),
                ]);
        }

        return $this->render('reserva/completaInvitadoSelf.html.twig', [
            'invitado' => $invitado,
            'form' => $form,
        ]);
    }

    #[Route(path: '/consulta', name: 'reserva_consulta', methods: ['GET', 'POST'])]
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
                    'email' => $reservante->getEmail(),
                ]);
        }

        return $this->render('reserva/consulta_reserva.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'reserva_delete', methods: ['DELETE'])]
    public function delete(Request $request, Reservante $reservante, EventDispatcherInterface $dispatcher,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservante->getId(), $request->request->get('_token'))) {
            $celebracion = $reservante->getCelebracion();

            $invitados = $reservante->getInvitados();
            foreach ($invitados as $invitado) {
                $entityManager->remove($invitado);
            }

            $entityManager->remove($reservante);
            $entityManager->flush();

            $event = new ReservaEvent($celebracion);
            $dispatcher->dispatch($event, ReservaEvent::ANULA_RESERVA);

            $this->addFlash('success', 'Se canceló la reserva correctamente.');
            $response = new Response();
            $response->headers->clearCookie('email');
            $response->headers->removeCookie('email');
        }

        return $this->redirectToRoute('reserva_index');
    }

    #[Route(path: '/cancela/{id}/invitado', name: 'cancela_invitado', methods: ['GET'])]
    public function cancelaReserva(Invitado $invitado, EntityManagerInterface $entityManager): Response
    {
        $celebracion = $invitado->getCelebracion()->getId();
        $email = $invitado->getEnlace()->getEmail();
        $entityManager->remove($invitado);
        $entityManager->flush();
        $this->addFlash('success', 'Se canceló reserva.');

        return $this->redirectToRoute('vista_reserva',
            [
                'celebracion' => $celebracion,
                'email' => $email,
            ]);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route(path: '/avisarme/{celebracion}', name: 'add_to_waiting_list')]
    public function addToWaitingList(Celebracion $celebracion, Request $request, EntityManagerInterface $em, Mailer $mailer): Response
    {
        $espera = new WaitingList();
        $espera->setCelebracion($celebracion);
        $form = $this->createForm(AvisoType::class, $espera, [
            'attr' => ['id' => 'formAviso'],
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservado = $em->getRepository(Reservante::class)->findOneByReserva($celebracion->getId(), $espera->getEmail());

            if ($reservado) {
                $this->addFlash('success', 'Ya se encuentra una reservación para esta celebracion y con ese mail');

                return $this->redirectToRoute('reserva_index');
            }

            $em->persist($espera);
            $em->flush();
            $mailer->sendAvisoRegistroReservaMessage($espera);
            $this->addFlash('success', 'Se ha guardado su registro');

            return $this->redirectToRoute('reserva_index', [
            ]);
        }

        return $this->render('reserva/vistaAvisoReserva.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form,
        ]);
    }
}
