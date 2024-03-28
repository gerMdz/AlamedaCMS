<?php

namespace App\Controller;

use App\Entity\PageIndex;
use App\Form\PageIndexType;
use App\Repository\PageIndexRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/page/index')]
class PageIndexController extends AbstractController
{
    #[Route(path: '/', name: 'page_index_index', methods: ['GET'])]
    public function index(PageIndexRepository $pageIndexRepository): Response
    {
        return $this->render('page_index/index.html.twig', [
            'page_indices' => $pageIndexRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'page_index_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pageIndex = new PageIndex();
        $form = $this->createForm(PageIndexType::class, $pageIndex);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pageIndex);
            $entityManager->flush();

            return $this->redirectToRoute('page_index_index');
        }

        return $this->render('page_index/new.html.twig', [
            'page_index' => $pageIndex,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'page_index_show', methods: ['GET'])]
    public function show(PageIndex $pageIndex): Response
    {
        return $this->render('page_index/show.html.twig', [
            'page_index' => $pageIndex,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'page_index_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PageIndex $pageIndex, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PageIndexType::class, $pageIndex);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('page_index_index');
        }

        return $this->render('page_index/edit.html.twig', [
            'page_index' => $pageIndex,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'page_index_delete', methods: ['DELETE'])]
    public function delete(Request $request, PageIndex $pageIndex, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pageIndex->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pageIndex);
            $entityManager->flush();
        }

        return $this->redirectToRoute('page_index_index');
    }
}
