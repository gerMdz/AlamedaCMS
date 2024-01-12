<?php

namespace App\Controller;

use App\Entity\ButtonLink;
use App\Form\ButtonLinkType;
use App\Repository\ButtonLinkRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/buttonlink')]
class ButtonLinkController extends AbstractController
{
    #[Route(path: '/', name: 'button_link_index', methods: ['GET'])]
    public function index(ButtonLinkRepository $buttonLinkRepository): Response
    {
        return $this->render('button_link/index.html.twig', [
            'button_links' => $buttonLinkRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'button_link_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $buttonLink = new ButtonLink();
        $form = $this->createForm(ButtonLinkType::class, $buttonLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($buttonLink);
            $entityManager->flush();

            return $this->redirectToRoute('button_link_index');
        }

        return $this->render('button_link/new.html.twig', [
            'button_link' => $buttonLink,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'button_link_show', methods: ['GET'])]
    public function show(ButtonLink $buttonLink): Response
    {
        return $this->render('button_link/show.html.twig', [
            'button_link' => $buttonLink,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'button_link_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ButtonLink $buttonLink, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ButtonLinkType::class, $buttonLink);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('button_link_index');
        }

        return $this->render('button_link/edit.html.twig', [
            'button_link' => $buttonLink,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'button_link_delete', methods: ['DELETE'])]
    public function delete(Request $request, ButtonLink $buttonLink, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$buttonLink->getId(), $request->request->get('_token'))) {

            $entityManager->remove($buttonLink);
            $entityManager->flush();
        }

        return $this->redirectToRoute('button_link_index');
    }
}
