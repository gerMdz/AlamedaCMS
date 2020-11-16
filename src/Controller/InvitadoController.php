<?php

namespace App\Controller;

use App\Entity\Invitado;
use App\Form\InvitadoType;
use App\Repository\InvitadoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/invitado")
 */
class InvitadoController extends AbstractController
{
    /**
     * @Route("/", name="invitado_index", methods={"GET"})
     */
    public function index(InvitadoRepository $invitadoRepository): Response
    {
        return $this->render('invitado/index.html.twig', [
            'invitados' => $invitadoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="invitado_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $invitado = new Invitado();
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($invitado);
            $entityManager->flush();

            return $this->redirectToRoute('invitado_index');
        }

        return $this->render('invitado/new.html.twig', [
            'invitado' => $invitado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invitado_show", methods={"GET"})
     */
    public function show(Invitado $invitado): Response
    {
        return $this->render('invitado/show.html.twig', [
            'invitado' => $invitado,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="invitado_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Invitado $invitado): Response
    {
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('invitado_index');
        }

        return $this->render('invitado/edit.html.twig', [
            'invitado' => $invitado,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="invitado_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Invitado $invitado): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invitado->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($invitado);
            $entityManager->flush();
        }

        return $this->redirectToRoute('invitado_index');
    }
}
