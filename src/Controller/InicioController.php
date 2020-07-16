<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Entity\Principal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route("/ingreso", name="app_ingreso")
     * @param AuthenticationUtils $authenticationUtils
     * @return RedirectResponse
     */
    public function ingreso(AuthenticationUtils $authenticationUtils)
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/{linkRoute}", name="principal_ver", methods={"GET"})
     * @param Principal $principal
     * @return Response
     */
    public function ver(Principal $principal): Response
    {
        $vista = $principal->getLinkRoute();
        return $this->render('inicio/'.$vista.'.html.twig', [
            'principal' => $principal,
        ]);
    }

    /**
     * @Route("/{id}", name="principal_show", methods={"GET"})
     * @param Principal $principal
     * @return Response
     */
    public function show(Principal $principal): Response
    {
        $vista = $principal->getLinkRoute();

        return $this->render($vista.'.html.twig', [
            'principal' => $principal,
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
     * @Route("/avanza", name="avanza")
     */
    public function avanza()
    {
        return $this->render('inicio/avanza.html.twig', []);
    }

    /**
     * @Route("/grupospequeños", name="gpc", options = {"utf8": true })
     */
    public function gpc()
    {
        return $this->render('inicio/grupospequeños.html.twig', []);
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
