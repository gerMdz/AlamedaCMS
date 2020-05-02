<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Repository\IndexAlamedaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class PerfilController extends AbstractController
{
    /**
     * @Route("/perfil", name="app_perfil")
     */
    public function index(IndexAlamedaRepository $indexAlamedaRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();
        return $this->render('perfil/perfil_index.html.twig', [
            'datosIndex'=> $indexAlamedaRepository->findAll()[0]
        ]);
    }
}
