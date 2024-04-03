<?php

namespace App\Controller;

use App\Entity\MetaBase;
use App\Form\MetaBaseType;
use App\Repository\MetaBaseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/admin/metabase')]
class MetaBaseController extends AbstractController
{
    #[Route(path: '/', name: 'meta_base_index', methods: ['GET'])]
    public function index(MetaBaseRepository $metaBaseRepository): Response
    {
        return $this->render('meta_base/index.html.twig', [
            'meta_bases' => $metaBaseRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'meta_base_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $metaBase = new MetaBase();
        $form = $this->createForm(MetaBaseType::class, $metaBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($metaBase);
            $entityManager->flush();

            return $this->redirectToRoute('meta_base_index');
        }

        return $this->render('meta_base/new.html.twig', [
            'meta_base' => $metaBase,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'meta_base_show', methods: ['GET'])]
    public function show(MetaBase $metaBase): Response
    {
        return $this->render('meta_base/show.html.twig', [
            'meta_base' => $metaBase,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'meta_base_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MetaBase $metaBase, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MetaBaseType::class, $metaBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('meta_base_index');
        }

        return $this->render('meta_base/edit.html.twig', [
            'meta_base' => $metaBase,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'meta_base_delete', methods: ['DELETE'])]
    public function delete(Request $request, MetaBase $metaBase, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metaBase->getId(), $request->request->get('_token'))) {
            $entityManager->remove($metaBase);
            $entityManager->flush();
        }

        return $this->redirectToRoute('meta_base_index');
    }
}
