<?php

namespace App\Controller;

use App\Entity\BarraNav;
use App\Form\BarraNavType;
use App\Repository\BarraNavRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/barraNav")
 */
class BarraNavController extends AbstractController
{
    /**
     * @Route("/", name="admin_barra_nav_index", methods={"GET"})
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(BarraNavRepository $barraNavRepository): Response
    {
        return $this->render('admin/barra_nav/index.html.twig', [
            'barra_navs' => $barraNavRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_barra_nav_new", methods={"GET", "POST"})
     */
    public function new(Request $request, BarraNavRepository $barraNavRepository): Response
    {
        $barraNav = new BarraNav();
        $form = $this->createForm(BarraNavType::class, $barraNav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barraNavRepository->add($barraNav, true);

            return $this->redirectToRoute('admin_barra_nav_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/barra_nav/new.html.twig', [
            'barra_nav' => $barraNav,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_barra_nav_show", methods={"GET"})
     */
    public function show(BarraNav $barraNav): Response
    {
        return $this->render('admin/barra_nav/show.html.twig', [
            'barra_nav' => $barraNav,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_barra_nav_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, BarraNav $barraNav, BarraNavRepository $barraNavRepository): Response
    {
        $form = $this->createForm(BarraNavType::class, $barraNav);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $barraNavRepository->add($barraNav, true);

            return $this->redirectToRoute('admin_barra_nav_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/barra_nav/edit.html.twig', [
            'barra_nav' => $barraNav,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_barra_nav_delete", methods={"POST"})
     */
    public function delete(Request $request, BarraNav $barraNav, BarraNavRepository $barraNavRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$barraNav->getId(), $request->request->get('_token'))) {
            $barraNavRepository->remove($barraNav, true);
        }

        return $this->redirectToRoute('admin_barra_nav_index', [], Response::HTTP_SEE_OTHER);
    }
}
