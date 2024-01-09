<?php

namespace App\Controller;

use App\Entity\TypeBlock;
use App\Form\TypeBlockType;
use App\Repository\TypeBlockRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/typeblock')]
class TypeBlockController extends AbstractController
{
    #[Route(path: '/', name: 'type_block_index', methods: ['GET'])]
    public function index(TypeBlockRepository $typeBlockRepository): Response
    {
        return $this->render('type_block/index.html.twig', [
            'type_blocks' => $typeBlockRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'type_block_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request): Response
    {
        $typeBlock = new TypeBlock();
        $form = $this->createForm(TypeBlockType::class, $typeBlock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeBlock);
            $entityManager->flush();

            return $this->redirectToRoute('type_block_index');
        }

        return $this->render('type_block/new.html.twig', [
            'type_block' => $typeBlock,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'type_block_show', methods: ['GET'])]
    public function show(TypeBlock $typeBlock): Response
    {
        return $this->render('type_block/show.html.twig', [
            'type_block' => $typeBlock,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'type_block_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, TypeBlock $typeBlock): Response
    {
        $form = $this->createForm(TypeBlockType::class, $typeBlock);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_block_index');
        }

        return $this->render('type_block/edit.html.twig', [
            'type_block' => $typeBlock,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'type_block_delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, TypeBlock $typeBlock): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeBlock->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeBlock);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_block_index');
    }
}
