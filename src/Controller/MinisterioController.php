<?php

namespace App\Controller;

use App\Entity\Ministerio;
use App\Form\MinisterioType;
use App\Repository\MinisterioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/ministerio')]
class MinisterioController extends AbstractController
{
    #[Route(path: '/', name: 'ministerio_index', methods: ['GET'])]
    public function index(MinisterioRepository $ministerioRepository): Response
    {
        return $this->render('ministerio/index.html.twig', [
            'ministerios' => $ministerioRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'ministerio_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $ministerio = new Ministerio();
        $form = $this->createForm(MinisterioType::class, $ministerio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ministerio);
            $entityManager->flush();

            return $this->redirectToRoute('ministerio_index');
        }

        return $this->render('ministerio/new.html.twig', [
            'ministerio' => $ministerio,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'ministerio_show', methods: ['GET'])]
    public function show(Ministerio $ministerio): Response
    {
        return $this->render('ministerio/show.html.twig', [
            'ministerio' => $ministerio,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'ministerio_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ministerio $ministerio): Response
    {
        $form = $this->createForm(MinisterioType::class, $ministerio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ministerio_index');
        }

        return $this->render('ministerio/edit.html.twig', [
            'ministerio' => $ministerio,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'ministerio_delete', methods: ['DELETE'])]
    public function delete(Request $request, Ministerio $ministerio): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ministerio->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ministerio);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ministerio_index');
    }
}
