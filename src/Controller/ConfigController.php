<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConfigController extends AbstractController
{
    #[Route(path: '/config', name: 'config')]
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('config/index.html.twig', [
            'controller_name' => 'ConfigController',
        ]);
    }
}
