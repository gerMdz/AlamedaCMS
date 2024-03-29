<?php

namespace App\Controller;

use App\Repository\ComentarioRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminComentariosController extends AbstractController
{
    #[Route(path: '/admin/comentarios', name: 'admin_comentarios')]
    public function index(ComentarioRepository $comentarioRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $q = $request->query->get('q');
        $queryBuilder = $comentarioRepository->searchQueryBuilder($q);

        $comentarios = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            10/* limit per page */
        );

        return $this->render('admin_comentarios/index.html.twig', [
            'comentarios' => $comentarios,
        ]);
    }
}
