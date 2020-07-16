<?php

namespace App\Controller;

use App\Entity\Section;
use App\Form\SectionFormType;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SectionController
 * @package App\Controller
 * @Route("/admin/section")
 */
class SectionController extends AbstractController
{
    /**
     * @param SectionRepository $repository
     * @Route("/", name="admin_section_list")
     * @return Response
     */
    public function list(SectionRepository $repository)
    {
        return $this->render('section_admin/list.html.twig',[
            'sections' => $repository->findAll()
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     * @Route("/new", name="admin_section_new")
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(SectionFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() ){
            /** @var Section $section */
            $section = $form->getData();
            $em->persist($section);
            $em->flush();

            $this->addFlash('success', 'Sección creada. Gracias por su contribución');

            return $this->redirectToRoute('admin_section_list');
        }
        return $this->render('section_admin/new.html.twig', [
            'sectionForm' => $form->createView()
        ]);
    }
}
