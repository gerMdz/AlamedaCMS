<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class InicioController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();
        return $this->render('inicio/index.html.twig', [
            'controller_name' => 'InicioController',
            'datosIndex' => $indexAlameda[0]
        ]);
    }

    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto()
    {
        return $this->render('inicio/contacto.html.twig',[]);
    }
}
