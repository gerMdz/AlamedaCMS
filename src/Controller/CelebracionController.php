<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Form\CelebracionType;
use App\Repository\CelebracionRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/admin/celebracion")
 * @IsGranted("ROLE_RESERVA")
 */
class CelebracionController extends AbstractController
{
    /**
     * @Route("/", name="celebracion_index", methods={"GET"})
     * @param CelebracionRepository $celebracionRepository
     * @return Response
     */
    public function index(CelebracionRepository $celebracionRepository): Response
    {
        return $this->render('celebracion/index.html.twig', [
            'celebracions' => $celebracionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="celebracion_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $celebracion = new Celebracion();
        $form = $this->createForm(CelebracionType::class, $celebracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $ahora = new DateTime('now');
            $celebracion->setCreaEvento($user);
            $celebracion->setCreatedAt($ahora);
            $celebracion->setUpdatedAt($ahora);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($celebracion);
            $entityManager->flush();

            return $this->redirectToRoute('celebracion_index');
        }

        return $this->render('celebracion/new.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="celebracion_show", methods={"GET"})
     */
    public function show(Celebracion $celebracion): Response
    {
        return $this->render('celebracion/show.html.twig', [
            'celebracion' => $celebracion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="celebracion_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Celebracion $celebracion): Response
    {
        $form = $this->createForm(CelebracionType::class, $celebracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('celebracion_index');
        }

        return $this->render('celebracion/edit.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="celebracion_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Celebracion $celebracion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$celebracion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($celebracion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('celebracion_index');
    }
}
