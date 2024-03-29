<?php

namespace App\Controller;

use App\Entity\TipoContacto;
use App\Form\TipoContactoType;
use App\Repository\TipoContactoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/admin/tipocontacto')]
class TipoContactoController extends AbstractController
{
    #[Route(path: '/', name: 'tipo_contacto_index', methods: ['GET'])]
    public function index(TipoContactoRepository $tipoContactoRepository): Response
    {
        return $this->render('tipo_contacto/index.html.twig', [
            'tipo_contactos' => $tipoContactoRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'tipo_contacto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tipoContacto = new TipoContacto();
        $form = $this->createForm(TipoContactoType::class, $tipoContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tipoContacto);
            $entityManager->flush();

            return $this->redirectToRoute('tipo_contacto_index');
        }

        return $this->render('tipo_contacto/new.html.twig', [
            'tipo_contacto' => $tipoContacto,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'tipo_contacto_show', methods: ['GET'])]
    public function show(TipoContacto $tipoContacto): Response
    {
        return $this->render('tipo_contacto/show.html.twig', [
            'tipo_contacto' => $tipoContacto,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'tipo_contacto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TipoContacto $tipoContacto, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TipoContactoType::class, $tipoContacto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('tipo_contacto_index');
        }

        return $this->render('tipo_contacto/edit.html.twig', [
            'tipo_contacto' => $tipoContacto,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'tipo_contacto_delete', methods: ['DELETE'])]
    public function delete(Request $request, TipoContacto $tipoContacto, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tipoContacto->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tipoContacto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tipo_contacto_index');
    }
}
