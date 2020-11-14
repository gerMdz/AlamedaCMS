<?php

namespace App\Controller;

use App\Entity\Reservante;
use App\Form\ReservanteType;
use App\Repository\ReservanteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservante")
 */
class ReservanteController extends AbstractController
{
    /**
     * @Route("/", name="reservante_index", methods={"GET"})
     */
    public function index(ReservanteRepository $reservanteRepository): Response
    {
        return $this->render('reservante/index.html.twig', [
            'reservantes' => $reservanteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="reservante_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $reservante = new Reservante();
        $form = $this->createForm(ReservanteType::class, $reservante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reservante);
            $entityManager->flush();

            return $this->redirectToRoute('reservante_index');
        }

        return $this->render('reservante/new.html.twig', [
            'reservante' => $reservante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservante_show", methods={"GET"})
     */
    public function show(Reservante $reservante): Response
    {
        return $this->render('reservante/show.html.twig', [
            'reservante' => $reservante,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="reservante_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reservante $reservante): Response
    {
        $form = $this->createForm(ReservanteType::class, $reservante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservante_index');
        }

        return $this->render('reservante/edit.html.twig', [
            'reservante' => $reservante,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="reservante_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reservante $reservante): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservante->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reservante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reservante_index');
    }
}
