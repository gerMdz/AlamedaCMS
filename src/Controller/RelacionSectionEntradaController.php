<?php

namespace App\Controller;

use App\Entity\RelacionSectionEntrada;
use App\Form\RelacionSectionEntradaType;
use App\Repository\RelacionSectionEntradaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/relacion/section/entrada')]
class RelacionSectionEntradaController extends AbstractController
{
    #[Route(path: '/', name: 'relacion_section_entrada_index', methods: ['GET'])]
    public function index(RelacionSectionEntradaRepository $relacionSectionEntradaRepository): Response
    {
        return $this->render('relacion_section_entrada/index.html.twig', [
            'relacion_section_entradas' => $relacionSectionEntradaRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'relacion_section_entrada_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $relacionSectionEntrada = new RelacionSectionEntrada();
        $form = $this->createForm(RelacionSectionEntradaType::class, $relacionSectionEntrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($relacionSectionEntrada);
            $entityManager->flush();

            return $this->redirectToRoute('relacion_section_entrada_index');
        }

        return $this->render('relacion_section_entrada/new.html.twig', [
            'relacion_section_entrada' => $relacionSectionEntrada,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'relacion_section_entrada_show', methods: ['GET'])]
    public function show(RelacionSectionEntrada $relacionSectionEntrada): Response
    {
        return $this->render('relacion_section_entrada/show.html.twig', [
            'relacion_section_entrada' => $relacionSectionEntrada,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'relacion_section_entrada_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RelacionSectionEntrada $relacionSectionEntrada, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RelacionSectionEntradaType::class, $relacionSectionEntrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('relacion_section_entrada_index');
        }

        return $this->render('relacion_section_entrada/edit.html.twig', [
            'relacion_section_entrada' => $relacionSectionEntrada,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'relacion_section_entrada_delete', methods: ['DELETE'])]
    public function delete(Request $request, RelacionSectionEntrada $relacionSectionEntrada, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$relacionSectionEntrada->getId(), $request->request->get('_token'))) {
            $entityManager->remove($relacionSectionEntrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('relacion_section_entrada_index');
    }
}
