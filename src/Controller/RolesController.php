<?php

namespace App\Controller;

use App\Entity\Roles;
use App\Form\RolesType;
use App\Repository\RolesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/roles')]
class RolesController extends AbstractController
{
    #[Route(path: '/', name: 'roles_list', methods: ['GET'])]
    public function list(RolesRepository $rolesRepository): Response
    {
        return $this->render('roles/list.html.twig', [
            'roles' => $rolesRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'roles_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $role = new Roles();
        $form = $this->createForm(RolesType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($role);
            $entityManager->flush();

            return $this->redirectToRoute('roles_list');
        }

        return $this->render('roles/new.html.twig', [
            'role' => $role,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'roles_show', methods: ['GET'])]
    public function show(Roles $role): Response
    {
        return $this->render('roles/show.html.twig', [
            'role' => $role,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'roles_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Roles $role, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RolesType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('roles_list');
        }

        return $this->render('roles/edit.html.twig', [
            'role' => $role,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'roles_delete', methods: ['DELETE'])]
    public function delete(Request $request, Roles $role, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $entityManager->remove($role);
            $entityManager->flush();
        }

        return $this->redirectToRoute('roles_list');
    }
}
