<?php

namespace App\Controller;

use App\Entity\TipoContacto;
use App\Form\TipoContactoType;
use App\Repository\TipoContactoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tipo/contacto")
 */
class TipoContactoController extends AbstractController
{
    /**
     * @Route("/", name="tipo_contacto_index", methods={"GET"})
     */
    public function index(TipoContactoRepository $tipoContactoRepository): Response
    {
        return $this->render('tipo_contacto/index.html.twig', [
            'tipo_contactos' => $tipoContactoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tipo_contacto_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tipoContacto = new TipoContacto();
        $form = $this->createForm(TipoContactoType::class, $tipoContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tipoContacto);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_contacto_index');
        }

        return $this->render('tipo_contacto/new.html.twig', [
            'tipo_contacto' => $tipoContacto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_contacto_show", methods={"GET"})
     */
    public function show(TipoContacto $tipoContacto): Response
    {
        return $this->render('tipo_contacto/show.html.twig', [
            'tipo_contacto' => $tipoContacto,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tipo_contacto_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TipoContacto $tipoContacto): Response
    {
        $form = $this->createForm(TipoContactoType::class, $tipoContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tipo_contacto_index');
        }

        return $this->render('tipo_contacto/edit.html.twig', [
            'tipo_contacto' => $tipoContacto,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tipo_contacto_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TipoContacto $tipoContacto): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoContacto->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tipoContacto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_contacto_index');
    }
}
