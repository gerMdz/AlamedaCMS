<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ConfigController extends AbstractController
{
    /**
     * @Route("/config", name="config")
     */
    public function index()
    {
        return $this->render('config/index.html.twig', [
            'controller_name' => 'ConfigController',
        ]);
    }
}
