<?php

namespace App\Controller;

use App\Entity\MetaBase;
use App\Form\MetaBaseType;
use App\Repository\MetaBaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/metabase")
 */
class MetaBaseController extends AbstractController
{
    /**
     * @Route("/", name="meta_base_index", methods={"GET"})
     */
    public function index(MetaBaseRepository $metaBaseRepository): Response
    {
        return $this->render('meta_base/index.html.twig', [
            'meta_bases' => $metaBaseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="meta_base_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $metaBase = new MetaBase();
        $form = $this->createForm(MetaBaseType::class, $metaBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($metaBase);
            $entityManager->flush();

            return $this->redirectToRoute('meta_base_index');
        }

        return $this->render('meta_base/new.html.twig', [
            'meta_base' => $metaBase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meta_base_show", methods={"GET"})
     */
    public function show(MetaBase $metaBase): Response
    {
        return $this->render('meta_base/show.html.twig', [
            'meta_base' => $metaBase,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="meta_base_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, MetaBase $metaBase): Response
    {
        $form = $this->createForm(MetaBaseType::class, $metaBase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('meta_base_index');
        }

        return $this->render('meta_base/edit.html.twig', [
            'meta_base' => $metaBase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="meta_base_delete", methods={"DELETE"})
     */
    public function delete(Request $request, MetaBase $metaBase): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metaBase->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($metaBase);
            $entityManager->flush();
        }

        return $this->redirectToRoute('meta_base_index');
    }
}
