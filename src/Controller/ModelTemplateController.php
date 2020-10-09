<?php

namespace App\Controller;

use App\Entity\ModelTemplate;
use App\Form\ModelTemplateType;
use App\Repository\ModelTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/model/template")
 */
class ModelTemplateController extends AbstractController
{
    /**
     * @Route("/", name="model_template_index", methods={"GET"})
     * @param ModelTemplateRepository $modelTemplateRepository
     * @return Response
     */
    public function index(ModelTemplateRepository $modelTemplateRepository): Response
    {
        return $this->render('model_template/index.html.twig', [
            'model_templates' => $modelTemplateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="model_template_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $modelTemplate = new ModelTemplate();
        $form = $this->createForm(ModelTemplateType::class, $modelTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modelTemplate);
            $entityManager->flush();

            return $this->redirectToRoute('model_template_index');
        }

        return $this->render('model_template/new.html.twig', [
            'model_template' => $modelTemplate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="model_template_show", methods={"GET"})
     * @param ModelTemplate $modelTemplate
     * @return Response
     */
    public function show(ModelTemplate $modelTemplate): Response
    {
        return $this->render('model_template/show.html.twig', [
            'model_template' => $modelTemplate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="model_template_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ModelTemplate $modelTemplate
     * @return Response
     */
    public function edit(Request $request, ModelTemplate $modelTemplate): Response
    {
        $form = $this->createForm(ModelTemplateType::class, $modelTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('model_template_index');
        }

        return $this->render('model_template/edit.html.twig', [
            'model_template' => $modelTemplate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="model_template_delete", methods={"DELETE"})
     * @param Request $request
     * @param ModelTemplate $modelTemplate
     * @return Response
     */
    public function delete(Request $request, ModelTemplate $modelTemplate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modelTemplate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modelTemplate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('model_template_index');
    }
}
