<?php

namespace App\Controller\Admin;

use App\Entity\Organization;
use App\Form\OrganizationType;
use App\Repository\OrganizationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/organization")
 */
class OrganizationController extends AbstractController
{
    /**
     * @Route("/", name="admin_organization_index", methods={"GET"})
     */
    public function index(OrganizationRepository $organizationRepository): Response
    {
        return $this->render('admin/organization/index.html.twig', [
            'organizations' => $organizationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_organization_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OrganizationRepository $organizationRepository): Response
    {
        $organization = new Organization();
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $organizationRepository->add($organization, true);

            return $this->redirectToRoute('admin_organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/organization/new.html.twig', [
            'organization' => $organization,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_organization_show", methods={"GET"})
     */
    public function show(Organization $organization): Response
    {
        return $this->render('admin/organization/show.html.twig', [
            'organization' => $organization,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_organization_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Organization $organization, OrganizationRepository $organizationRepository): Response
    {
        $form = $this->createForm(OrganizationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $organizationRepository->add($organization, true);

            return $this->redirectToRoute('admin_organization_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/organization/edit.html.twig', [
            'organization' => $organization,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_organization_delete", methods={"POST"})
     */
    public function delete(Request $request, Organization $organization, OrganizationRepository $organizationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$organization->getId(), $request->request->get('_token'))) {
            $organizationRepository->remove($organization, true);
        }

        return $this->redirectToRoute('admin_organization_index', [], Response::HTTP_SEE_OTHER);
    }
}
