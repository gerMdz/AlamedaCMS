<?php

namespace App\Controller;

use App\Repository\ComentarioRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminComentariosController extends AbstractController
{
    /**
     * @Route("/admin/comentarios", name="admin_comentarios")
     * @param ComentarioRepository $comentarioRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function index(ComentarioRepository $comentarioRepository, Request $request, PaginatorInterface $paginator)
    {
        $q = $request->query->get('q');
        $queryBuilder = $comentarioRepository->searchQueryBuilder($q);

        $comentarios = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        return $this->render('admin_comentarios/index.html.twig', [
            'comentarios' => $comentarios
        ]);
    }
}
