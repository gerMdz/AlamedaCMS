<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaType;
use App\Repository\EntradaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entrada")
 */
class EntradaController extends AbstractController
{
    /**
     * @Route("/", name="entrada_index", methods={"GET"})
     * @param EntradaRepository $entradaRepository
     * @return Response
     */
    public function index(EntradaRepository $entradaRepository): Response
    {
        return $this->render('entrada/index.html.twig', [
            'entradas' => $entradaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="entrada_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $entrada = new Entrada();
        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('entrada_index');
        }

        return $this->render('entrada/new.html.twig', [
            'entrada' => $entrada,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{linkRoute}", name="entrada_ver", methods={"GET"})
     * @param string $linkRoute
     * @param EntradaRepository $er
     * @return Response
     */
    public function ver(Entrada $entrada, EntradaRepository $er): Response
    {
        $entrada = $er->findOneBy(['linkRoute' => $entrada->getLinkRoute()]);
        if (!$entrada) {
            throw $this->createNotFoundException(sprintf('No se encontró la entrada "%s"', $linkRoute));
        }

        return $this->render('entrada/show.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/{id}/show", name="entrada_show", methods={"GET"})
     * @param Entrada $entrada
     * @param EntradaRepository $er
     * @return Response
     */
    public function show(Entrada $entrada, EntradaRepository $er): Response
    {
//        $entrada = $er->findOneBy(['linkRoute' => $entrada]);
        if (!$entrada) {
            throw $this->createNotFoundException(sprintf('No se encontró la entrada "%s"', $entrada));
        }
        return $this->render('entrada/show.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/{id}", name="entrada_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Entrada $entrada): Response
    {
        if ($this->isCsrfTokenValid('delete' . $entrada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('entrada_index');
    }
}
