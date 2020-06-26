<?php

namespace App\Controller;

use App\Repository\ComentarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminComentariosController extends AbstractController
{
    /**
     * @Route("/admin/comentarios", name="admin_comentarios")
     * @param ComentarioRepository $comentarioRepository
     * @return Response
     */
    public function index(ComentarioRepository $comentarioRepository)
    {
        $comentarios = $comentarioRepository->findBy([],['createdAt'=>'Desc']);
        return $this->render('admin_comentarios/index.html.twig', [
            'comentarios' => $comentarios
        ]);
    }
}
