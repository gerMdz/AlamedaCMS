<?php

namespace App\Controller;

use App\Form\SectionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     * @param EntityManagerInterface $em
     * @Route("/new", name="admin_section_new", methods={"GET"})
     * @return Response
     */
    public function new(EntityManagerInterface $em)
    {
        $form = $this->createForm(SectionFormType::class);
        return $this->render('section_admin/new.html.twig', [
            'sectionForm' => $form->createView()
        ]);
    }
}