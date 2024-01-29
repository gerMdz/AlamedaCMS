<?php

namespace App\Controller;

use App\Entity\EnlaceCorto;
use App\Form\EnlaceCortoType;
use App\Repository\EnlaceCortoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/enlaces')]
class EnlaceCortoController extends AbstractController
{
    #[Route(path: '/', name: 'enlace_corto_index', methods: ['GET'])]
    public function index(EnlaceCortoRepository $enlaceCortoRepository): Response
    {
        return $this->render('enlace_corto/index.html.twig', [
            'enlace_cortos' => $enlaceCortoRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'enlace_corto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $enlaceCorto = new EnlaceCorto();
        $form = $this->createForm(EnlaceCortoType::class, $enlaceCorto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($enlaceCorto);
            $entityManager->flush();

            return $this->redirectToRoute('enlace_corto_index');
        }

        return $this->render('enlace_corto/new.html.twig', [
            'enlace_corto' => $enlaceCorto,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{linkRoute}', name: 'enlace_corto_acceso', methods: ['GET'])]
    public function acceso(EnlaceCorto $enlaceCorto): Response
    {
        return $this->redirect($enlaceCorto->getUrlDestino());
    }

    #[Route(path: '/{linkRoute}/vista', name: 'enlace_corto_show', methods: ['GET'])]
    public function show(EnlaceCorto $enlaceCorto): Response
    {
        return $this->render('enlace_corto/show.html.twig', [
            'enlace_corto' => $enlaceCorto,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'enlace_corto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EnlaceCorto $enlaceCorto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EnlaceCortoType::class, $enlaceCorto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('enlace_corto_index');
        }

        return $this->render('enlace_corto/edit.html.twig', [
            'enlace_corto' => $enlaceCorto,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'enlace_corto_delete', methods: ['DELETE'])]
    public function delete(Request $request, EnlaceCorto $enlaceCorto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enlaceCorto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($enlaceCorto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enlace_corto_index');
    }

    #[Route(path: '/{enlace}', name: 'enlace_corto_pagina', methods: ['GET'])]
    public function irEnlace(string $enlace): RedirectResponse
    {
        return $this->redirect(
            $enlace
        );
    }
}
