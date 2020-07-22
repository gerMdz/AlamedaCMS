<?php

namespace App\Controller;

use App\Entity\Brote;
use App\Form\BroteType;
use App\Repository\BroteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/derivada")
 */
class BroteController extends AbstractController
{
    /**
     * @Route("/", name="derivada_index", methods={"GET"})
     * @param BroteRepository $derivadaRepository
     * @return Response
     */
    public function index(BroteRepository $derivadaRepository): Response
    {
        return $this->render('derivada/index.html.twig', [
            'derivadas' => $derivadaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="derivada_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $derivada = new Brote();
        $form = $this->createForm(BroteType::class, $derivada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($derivada);
            $entityManager->flush();

            return $this->redirectToRoute('derivada_index');
        }

        return $this->render('derivada/new.html.twig', [
            'derivada' => $derivada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="derivada_show", methods={"GET"})
     * @param Brote $derivada
     * @return Response
     */
    public function show(Brote $derivada): Response
    {
        return $this->render('derivada/show.html.twig', [
            'derivada' => $derivada,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="derivada_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Brote $derivada
     * @return Response
     */
    public function edit(Request $request, Brote $derivada): Response
    {
        $form = $this->createForm(BroteType::class, $derivada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('derivada_index');
        }

        return $this->render('derivada/edit.html.twig', [
            'derivada' => $derivada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="derivada_delete", methods={"DELETE"})
     * @param Request $request
     * @param Brote $derivada
     * @return Response
     */
    public function delete(Request $request, Brote $derivada): Response
    {
        if ($this->isCsrfTokenValid('delete'.$derivada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($derivada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('derivada_index');
    }
}
