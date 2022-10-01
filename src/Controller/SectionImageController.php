<?php

namespace App\Controller;

use App\Entity\SectionImage;
use App\Form\SectionImageType;
use App\Repository\SectionImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/section_image")
 */
class SectionImageController extends AbstractController
{
    /**
     * @Route("/", name="app_section_image_index", methods={"GET"})
     */
    public function index(SectionImageRepository $sectionImageRepository): Response
    {
        return $this->render('section_image/index.html.twig', [
            'section_images' => $sectionImageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_section_image_new", methods={"GET", "POST"})
     */
    public function new(Request $request, SectionImageRepository $sectionImageRepository): Response
    {
        $sectionImage = new SectionImage();
        $form = $this->createForm(SectionImageType::class, $sectionImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionImageRepository->add($sectionImage, true);

            return $this->redirectToRoute('app_section_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('section_image/new.html.twig', [
            'section_image' => $sectionImage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_section_image_show", methods={"GET"})
     */
    public function show(SectionImage $sectionImage): Response
    {
        return $this->render('section_image/show.html.twig', [
            'section_image' => $sectionImage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_section_image_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, SectionImage $sectionImage, SectionImageRepository $sectionImageRepository): Response
    {
        $form = $this->createForm(SectionImageType::class, $sectionImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sectionImageRepository->add($sectionImage, true);

            return $this->redirectToRoute('app_section_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('section_image/edit.html.twig', [
            'section_image' => $sectionImage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_section_image_delete", methods={"POST"})
     */
    public function delete(Request $request, SectionImage $sectionImage, SectionImageRepository $sectionImageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sectionImage->getId(), $request->request->get('_token'))) {
            $sectionImageRepository->remove($sectionImage, true);
        }
        $this->addFlash('success', 'Se eliminó la imagen de la sección');

        return $this->redirectToRoute('admin_section_add_images', ['section'=>$sectionImage->getSectionId()->getId()], Response::HTTP_SEE_OTHER);
    }
}
