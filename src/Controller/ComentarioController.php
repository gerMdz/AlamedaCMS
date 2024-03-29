<?php

namespace App\Controller;

use App\Entity\Comentario;
use App\Form\ComentarioType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/admin/comentario')]
class ComentarioController extends AbstractController
{
    #[Route(path: '/new', name: 'comentario_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $comentario = new Comentario();
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comentario);
            $entityManager->flush();

            return $this->redirectToRoute('admin_comentarios');
        }

        return $this->render('comentario/new.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'comentario_show', methods: ['GET'])]
    public function show(Comentario $comentario): Response
    {
        return $this->render('comentario/show.html.twig', [
            'comentario' => $comentario,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'comentario_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Comentario $comentario, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ComentarioType::class, $comentario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('admin_comentarios');
        }

        return $this->render('comentario/edit.html.twig', [
            'comentario' => $comentario,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'comentario_delete', methods: ['DELETE'])]
    public function delete(Request $request, Comentario $comentario, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comentario->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comentario);
            $entityManager->flush();
        }

        return $this->redirectToRoute('homepage');
    }
}
