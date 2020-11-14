<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminInvitadoController extends AbstractController
{
    /**
     * @Route("/admin/invitado", name="admin_invitado")
     */
    public function index(): Response
    {
        return $this->render('admin_invitado/index.html.twig', [
            'controller_name' => 'AdminInvitadoController',
        ]);
    }
}
