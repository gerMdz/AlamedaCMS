<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminReservanteController extends AbstractController
{
    /**
     * @Route("/admin/reservante", name="admin_reservante")
     */
    public function index(): Response
    {
        return $this->render('admin_reservante/index.html.twig', [
            'controller_name' => 'AdminReservanteController',
        ]);
    }
}
