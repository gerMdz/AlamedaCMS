<?php

namespace App\Controller;

use App\Entity\NewsSite;
use App\Form\NewsSiteType;
use App\Repository\NewsSiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/news-site")
 */
class NewsSiteController extends AbstractController
{
    /**
     * @Route("/", name="news_site_index", methods={"GET"})
     */
    public function index(NewsSiteRepository $newsSiteRepository): Response
    {
        return $this->render('news_site/index.html.twig', [
            'news_sites' => $newsSiteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="news_site_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $newsSite = new NewsSite();
        $form = $this->createForm(NewsSiteType::class, $newsSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newsSite);
            $entityManager->flush();

            return $this->redirectToRoute('news_site_index');
        }

        return $this->render('news_site/new.html.twig', [
            'news_site' => $newsSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_site_show", methods={"GET"})
     */
    public function show(NewsSite $newsSite): Response
    {
        return $this->render('news_site/show.html.twig', [
            'news_site' => $newsSite,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="news_site_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, NewsSite $newsSite): Response
    {
        $form = $this->createForm(NewsSiteType::class, $newsSite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('news_site_index');
        }

        return $this->render('news_site/edit.html.twig', [
            'news_site' => $newsSite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="news_site_delete", methods={"POST"})
     */
    public function delete(Request $request, NewsSite $newsSite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newsSite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($newsSite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('news_site_index');
    }
}
