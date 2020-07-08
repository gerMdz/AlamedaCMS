<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDerivadaController extends AbstractController
{
    /**
     * @Route("/admin/derivada", name="admin_derivada")
     */
    public function index()
    {
        return $this->render('admin_derivada/index.html.twig', [
            'controller_name' => 'AdminDerivadaController',
        ]);
    }
}
