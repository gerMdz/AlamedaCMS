<?php

namespace App\Controller;

use App\Entity\Reservante;
use App\Form\Filter\ReservaByEmailFilterType;
use App\Form\ReservanteType;
use App\Repository\ReservanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[\Symfony\Component\Routing\Attribute\Route(path: '/admin/reservante')]
#[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_RESERVA')]
class ReservanteController extends AbstractController
{
    #[\Symfony\Component\Routing\Attribute\Route(path: '/', name: 'reservante_index', methods: ['GET'])]
    public function index(ReservanteRepository $reservanteRepository): Response
    {
        return $this->render('reservante/index.html.twig', [
            'reservantes' => $reservanteRepository->findAll(),
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/lectura', name: 'reserva_lectura', methods: ['GET', 'POST'])]
    public function consultaReserva(Request $request, ReservanteRepository $reservanteRepository, EntityManagerInterface $entityManager): Response
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

        return $this->render('reserva/lectura_reserva.html.twig', [
            'form' => $form,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/new', name: 'reservante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservante = new Reservante();
        $form = $this->createForm(ReservanteType::class, $reservante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservante);
            $entityManager->flush();

            return $this->redirectToRoute('reservante_index');
        }

        return $this->render('reservante/new.html.twig', [
            'reservante' => $reservante,
            'form' => $form,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{id}', name: 'reservante_show', methods: ['GET'])]
    public function show(Reservante $reservante): Response
    {
        return $this->render('reservante/show.html.twig', [
            'reservante' => $reservante,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{id}/edit', name: 'reservante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservante $reservante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservanteType::class, $reservante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reservante_index');
        }

        return $this->render('reservante/edit.html.twig', [
            'reservante' => $reservante,
            'form' => $form,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{id}', name: 'reservante_delete', methods: ['DELETE'])]
    public function delete(Request $request, Reservante $reservante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservante->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reservante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservante_index');
    }
}
