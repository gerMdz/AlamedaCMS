<?php

namespace App\Controller;

use App\Repository\MetaBaseRepository;
use App\Repository\PrincipalRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param PrincipalRepository $principalRepository
     * @param MetaBaseRepository $metaBaseRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PrincipalRepository $principalRepository, MetaBaseRepository $metaBaseRepository, PaginatorInterface $paginator, Request $request)
    {
        $queryPrincipales = $principalRepository->queryFindAllPrincipals();
        $principales = $paginator->paginate(
            $queryPrincipales, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('admin/index.html.twig', [
            'principals' => $principales,
            'meta_bases' => $metaBaseRepository->findAll(),

        ]);
    }
}
