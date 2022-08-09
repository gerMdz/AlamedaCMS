<?php

namespace App\Controller;

use App\Entity\SourceApi;
use App\Form\SourceApiType;
use App\Repository\SourceApiRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/source_api")
 */
class SourceApiController extends AbstractController
{
    /**
     * @Route("/", name="app_source_api_index", methods={"GET"})
     */
    public function index(SourceApiRepository $sourceApiRepository): Response
    {
        return $this->render('admin/source_api/index.html.twig', [
            'source_apis' => $sourceApiRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_source_api_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SourceApiRepository $sourceApiRepository): Response
    {
        $sourceApi = new SourceApi();
        $form = $this->createForm(SourceApiType::class, $sourceApi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceApiRepository->add($sourceApi, true);

            return $this->redirectToRoute('app_source_api_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/source_api/new.html.twig', [
            'source_api' => $sourceApi,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_source_api_show", methods={"GET"})
     */
    public function show(SourceApi $sourceApi): Response
    {
        return $this->render('admin/source_api/show.html.twig', [
            'source_api' => $sourceApi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_source_api_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SourceApi $sourceApi, SourceApiRepository $sourceApiRepository): Response
    {
        $form = $this->createForm(SourceApiType::class, $sourceApi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sourceApiRepository->add($sourceApi, true);

            return $this->redirectToRoute('app_source_api_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/source_api/edit.html.twig', [
            'source_api' => $sourceApi,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_source_api_delete", methods={"POST"})
     */
    public function delete(Request $request, SourceApi $sourceApi, SourceApiRepository $sourceApiRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sourceApi->getId(), $request->request->get('_token'))) {
            $sourceApiRepository->remove($sourceApi, true);
        }

        return $this->redirectToRoute('app_source_api_index', [], Response::HTTP_SEE_OTHER);
    }
}
