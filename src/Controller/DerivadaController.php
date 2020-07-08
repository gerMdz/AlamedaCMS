<?php

namespace App\Controller;

use App\Entity\Derivada;
use App\Form\DerivadaType;
use App\Repository\DerivadaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/derivada")
 */
class DerivadaController extends AbstractController
{
    /**
     * @Route("/", name="derivada_index", methods={"GET"})
     */
    public function index(DerivadaRepository $derivadaRepository): Response
    {
        return $this->render('derivada/index.html.twig', [
            'derivadas' => $derivadaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="derivada_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $derivada = new Derivada();
        $form = $this->createForm(DerivadaType::class, $derivada);
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
     */
    public function show(Derivada $derivada): Response
    {
        return $this->render('derivada/show.html.twig', [
            'derivada' => $derivada,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="derivada_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Derivada $derivada): Response
    {
        $form = $this->createForm(DerivadaType::class, $derivada);
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
     */
    public function delete(Request $request, Derivada $derivada): Response
    {
        if ($this->isCsrfTokenValid('delete'.$derivada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($derivada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('derivada_index');
    }
}
