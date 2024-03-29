<?php

namespace App\Controller;

use App\Entity\TypeFixe;
use App\Form\TypeFixeType;
use App\Repository\TypeFixeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/admin/typefixe')]
class TypeFixeController extends AbstractController
{
    #[Route(path: '/', name: 'app_type_fixe_index', methods: ['GET'])]
    public function index(TypeFixeRepository $typeFixeRepository): Response
    {
        return $this->render('type_fixe/index.html.twig', [
            'type_fixes' => $typeFixeRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'app_type_fixe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TypeFixeRepository $typeFixeRepository): Response
    {
        $typeFixe = new TypeFixe();
        $form = $this->createForm(TypeFixeType::class, $typeFixe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeFixeRepository->add($typeFixe);

            return $this->redirectToRoute('app_type_fixe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_fixe/new.html.twig', [
            'type_fixe' => $typeFixe,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'app_type_fixe_show', methods: ['GET'])]
    public function show(TypeFixe $typeFixe): Response
    {
        return $this->render('type_fixe/show.html.twig', [
            'type_fixe' => $typeFixe,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'app_type_fixe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeFixe $typeFixe, TypeFixeRepository $typeFixeRepository): Response
    {
        $form = $this->createForm(TypeFixeType::class, $typeFixe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeFixeRepository->add($typeFixe);

            return $this->redirectToRoute('app_type_fixe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('type_fixe/edit.html.twig', [
            'type_fixe' => $typeFixe,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'app_type_fixe_delete', methods: ['POST'])]
    public function delete(Request $request, TypeFixe $typeFixe, TypeFixeRepository $typeFixeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeFixe->getId(), $request->request->get('_token'))) {
            $typeFixeRepository->remove($typeFixe);
        }

        return $this->redirectToRoute('app_type_fixe_index', [], Response::HTTP_SEE_OTHER);
    }
}
