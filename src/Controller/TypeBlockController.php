<?php

namespace App\Controller;

use App\Entity\TypeBlock;
use App\Form\TypeBlockType;
use App\Repository\TypeBlockRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/block")
 */
class TypeBlockController extends AbstractController
{
    /**
     * @Route("/", name="type_block_index", methods={"GET"})
     * @param TypeBlockRepository $typeBlockRepository
     * @return Response
     */
    public function index(TypeBlockRepository $typeBlockRepository): Response
    {
        return $this->render('type_block/index.html.twig', [
            'type_blocks' => $typeBlockRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_block_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
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

    /**
     * @Route("/{id}", name="type_block_show", methods={"GET"})
     * @param TypeBlock $typeBlock
     * @return Response
     */
    public function show(TypeBlock $typeBlock): Response
    {
        return $this->render('type_block/show.html.twig', [
            'type_block' => $typeBlock,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_block_edit", methods={"GET","POST"})
     * @param Request $request
     * @param TypeBlock $typeBlock
     * @return Response
     */
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

    /**
     * @Route("/{id}", name="type_block_delete", methods={"DELETE"})
     * @param Request $request
     * @param TypeBlock $typeBlock
     * @return Response
     */
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
