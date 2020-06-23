<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Entity\User;
use App\Repository\IndexAlamedaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 *
 * @method User|null getUser()
 */
class PerfilController extends AbstractController
{
    /**
     * @Route("web/perfil", name="app_perfil")
     *
     * @return Response
     */
    public function index(IndexAlamedaRepository $indexAlamedaRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();

        $user = $this->getUser()->getEmail();

        return $this->render('perfil/perfil_index.html.twig', [
            'datosIndex' => $indexAlamedaRepository->findAll()[0],
        ]);
    }

    /**
     * @Route("/api/perfil", name="api_perfil")
     */
    public function apiPerfil()
    {
        $user = $this->getUser();

        return $this->json($user, 200, [], [
            'groups' => ['perfil'],
        ]);
    }
}
