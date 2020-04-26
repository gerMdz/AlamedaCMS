<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();
        return $this->render('security/index.html.twig', [
            'datosIndex'=> $indexAlameda[0]

        ]);
    }
}
