<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Form\IndexAlamedaType;
use App\Repository\IndexAlamedaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/index/alameda")
 * @IsGranted("ROLE_ADMIN")
 */
class IndexAlamedaController extends AbstractController
{
    /**
     * @Route("/", name="index_alameda_index", methods={"GET"})
     */
    public function index(IndexAlamedaRepository $indexAlamedaRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();

        return $this->render('index_alameda/index.html.twig', [
            'index_alamedas' => $indexAlamedaRepository->findAll(),
            'datosIndex' => $indexAlamedaRepository->findAll()[0],
        ]);
    }

    /**
     * @Route("/new", name="index_alameda_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $indexAlameda = new IndexAlameda();
        $form = $this->createForm(IndexAlamedaType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($indexAlameda);
            $entityManager->flush();

            return $this->redirectToRoute('index_alameda_index');
        }

        return $this->render('index_alameda/new.html.twig', [
            'index_alameda' => $indexAlameda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="index_alameda_show", methods={"GET"})
     */
    public function show(IndexAlameda $indexAlameda): Response
    {
        return $this->render('index_alameda/show.html.twig', [
            'index_alameda' => $indexAlameda,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="index_alameda_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, IndexAlameda $indexAlameda): Response
    {
        $form = $this->createForm(IndexAlamedaType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('index_alameda_index');
        }

        return $this->render('index_alameda/edit.html.twig', [
            'index_alameda' => $indexAlameda,
            'datosIndex' => $indexAlameda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="index_alameda_delete", methods={"DELETE"})
     */
    public function delete(Request $request, IndexAlameda $indexAlameda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$indexAlameda->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($indexAlameda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index_alameda_index');
    }
}
