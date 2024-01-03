<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/alameda")
 */
class AlamedaController extends AbstractController
{
    /**
     * @Route("/{name}", name="alameda_name")
     */
    public function routeLink(string $name): Response
    {
        $ruta = $name.'.html.twig';

        return $this->render('alameda/'.$ruta, [
        ]);
    }

    /**
     * @Route("/", name="alameda")
     */
    public function index(): Response
    {
        return $this->render('alameda/index.html.twig', [
            'controller_name' => 'AlamedaController',
        ]);
    }
}
