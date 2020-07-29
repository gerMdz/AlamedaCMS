<?php

namespace App\Controller;

use App\Repository\MetaBaseRepository;
use App\Repository\PrincipalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     * @param PrincipalRepository $principalRepository
     * @param MetaBaseRepository $metaBaseRepository
     * @return Response
     */
    public function index(PrincipalRepository $principalRepository, MetaBaseRepository $metaBaseRepository)
    {

        return $this->render('admin/index.html.twig', [
            'principals' => $principalRepository->findAll(),
            'meta_bases' => $metaBaseRepository->findAll(),

        ]);
    }
}
