<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCelebracionController extends AbstractController
{
    /**
     * @Route("/admin/celebracion", name="admin_celebracion")
     */
    public function index(): Response
    {
        return $this->render('admin_celebracion/index.html.twig', [
            'controller_name' => 'AdminCelebracionController',
        ]);
    }
}
