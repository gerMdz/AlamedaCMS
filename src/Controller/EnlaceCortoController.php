<?php

namespace App\Controller;

use App\Entity\EnlaceCorto;
use App\Form\EnlaceCortoType;
use App\Repository\EnlaceCortoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/enlaces")
 */
class EnlaceCortoController extends AbstractController
{
    /**
     * @Route("/", name="enlace_corto_index", methods={"GET"})
     */
    public function index(EnlaceCortoRepository $enlaceCortoRepository): Response
    {
        return $this->render('enlace_corto/index.html.twig', [
            'enlace_cortos' => $enlaceCortoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="enlace_corto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enlaceCorto = new EnlaceCorto();
        $form = $this->createForm(EnlaceCortoType::class, $enlaceCorto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enlaceCorto);
            $entityManager->flush();

            return $this->redirectToRoute('enlace_corto_index');
        }

        return $this->render('enlace_corto/new.html.twig', [
            'enlace_corto' => $enlaceCorto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{linkRoute}", name="enlace_corto_acceso", methods={"GET"})
     */
    public function acceso(EnlaceCorto $enlaceCorto): Response
    {
        return $this->redirect($enlaceCorto->getUrlDestino());
    }

    /**
     * @Route("/{linkRoute}/vista", name="enlace_corto_show", methods={"GET"})
     */
    public function show(EnlaceCorto $enlaceCorto): Response
    {
        return $this->render('enlace_corto/show.html.twig', [
            'enlace_corto' => $enlaceCorto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enlace_corto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EnlaceCorto $enlaceCorto): Response
    {
        $form = $this->createForm(EnlaceCortoType::class, $enlaceCorto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enlace_corto_index');
        }

        return $this->render('enlace_corto/edit.html.twig', [
            'enlace_corto' => $enlaceCorto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enlace_corto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EnlaceCorto $enlaceCorto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enlaceCorto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enlaceCorto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enlace_corto_index');
    }
}
