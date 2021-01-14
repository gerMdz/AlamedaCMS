<?php

namespace App\Controller;

use App\Entity\Roles;
use App\Form\RolesType;
use App\Repository\RolesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/roles")
 */
class RolesController extends AbstractController
{
    /**
     * @Route("/", name="roles_list", methods={"GET"})
     * @param RolesRepository $rolesRepository
     * @return Response
     */
    public function list(RolesRepository $rolesRepository): Response
    {
        return $this->render('roles/list.html.twig', [
            'roles' => $rolesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="roles_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $role = new Roles();
        $form = $this->createForm(RolesType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();

            return $this->redirectToRoute('roles_list');
        }

        return $this->render('roles/new.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="roles_show", methods={"GET"})
     * @param Roles $role
     * @return Response
     */
    public function show(Roles $role): Response
    {
        return $this->render('roles/show.html.twig', [
            'role' => $role,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="roles_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Roles $role
     * @return Response
     */
    public function edit(Request $request, Roles $role): Response
    {
        $form = $this->createForm(RolesType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('roles_list');
        }

        return $this->render('roles/edit.html.twig', [
            'role' => $role,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="roles_delete", methods={"DELETE"})
     * @param Request $request
     * @param Roles $role
     * @return Response
     */
    public function delete(Request $request, Roles $role): Response
    {
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($role);
            $entityManager->flush();
        }

        return $this->redirectToRoute('roles_list');
    }
}
