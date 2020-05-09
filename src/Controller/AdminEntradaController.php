<?php

namespace App\Controller;

use App\Entity\Entrada;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminEntradaController extends AbstractController
{
    /**
     * @Route("/admin/entrada", name="admin_entrada")
     */
    public function index()
    {
//        return $this->render('admin_entrada/index.html.twig', [
//            'controller_name' => 'AdminEntradaController',
//        ]);
        dd('acceso denegado');
    }

    /**
     * @param Entrada $entrada
     * @Route("admin/entrada/{id}/edit", name="admin_entrada_edit")
     */
    public function edit(Entrada $entrada){

        if ($entrada->getAutor() != $this->getUser() && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException('No permitido');
        }
        dd($entrada);
    }
}
