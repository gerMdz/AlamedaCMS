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
            'datosIndex' => $indexAlameda[0],
        ]);
    }

    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto()
    {
        return $this->render('inicio/contacto.html.twig', []);
    }

    /**
     * @Route("/grupospequeños", name="gpc", options = {"utf8": true })
     */
    public function gpc()
    {
        return $this->render('inicio/gpc.html.twig', []);
    }

    /**
     * @Route("/ofrenda", name="ofrenda", options = {"utf8": true })
     */
    public function ofrenda()
    {
        return $this->render('inicio/ofrenda.html.twig', []);
    }

    /**
     * @Route("/notas", name="notas", options = {"utf8": true })
     */
    public function notas()
    {
        return $this->render('inicio/notas.html.twig', []);
    }

    /**
     * @Route("/oracion", name="oracion", options = {"utf8": true })
     */
    public function oracion()
    {
        return $this->render('inicio/oracion.html.twig', []);
    }
}
