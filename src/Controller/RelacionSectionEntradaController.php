<?php

namespace App\Controller;

use App\Entity\RelacionSectionEntrada;
use App\Form\RelacionSectionEntradaType;
use App\Repository\RelacionSectionEntradaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/relacion/section/entrada")
 */
class RelacionSectionEntradaController extends AbstractController
{
    /**
     * @Route("/", name="relacion_section_entrada_index", methods={"GET"})
     */
    public function index(RelacionSectionEntradaRepository $relacionSectionEntradaRepository): Response
    {
        return $this->render('relacion_section_entrada/index.html.twig', [
            'relacion_section_entradas' => $relacionSectionEntradaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="relacion_section_entrada_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $relacionSectionEntrada = new RelacionSectionEntrada();
        $form = $this->createForm(RelacionSectionEntradaType::class, $relacionSectionEntrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($relacionSectionEntrada);
            $entityManager->flush();

            return $this->redirectToRoute('relacion_section_entrada_index');
        }

        return $this->render('relacion_section_entrada/new.html.twig', [
            'relacion_section_entrada' => $relacionSectionEntrada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="relacion_section_entrada_show", methods={"GET"})
     */
    public function show(RelacionSectionEntrada $relacionSectionEntrada): Response
    {
        return $this->render('relacion_section_entrada/show.html.twig', [
            'relacion_section_entrada' => $relacionSectionEntrada,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="relacion_section_entrada_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RelacionSectionEntrada $relacionSectionEntrada): Response
    {
        $form = $this->createForm(RelacionSectionEntradaType::class, $relacionSectionEntrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('relacion_section_entrada_index');
        }

        return $this->render('relacion_section_entrada/edit.html.twig', [
            'relacion_section_entrada' => $relacionSectionEntrada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="relacion_section_entrada_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RelacionSectionEntrada $relacionSectionEntrada): Response
    {
        if ($this->isCsrfTokenValid('delete'.$relacionSectionEntrada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($relacionSectionEntrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('relacion_section_entrada_index');
    }
}
