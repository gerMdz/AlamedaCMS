<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaType;
use App\Repository\EntradaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/entrada")
 */
class EntradaController extends AbstractController
{


    /**
     * @Route("/{linkRoute}", name="entrada_ver", methods={"GET"})
     *
     * @param Entrada $entrada
     * @param EntradaRepository $er
     * @return Response
     */
    public function ver(Entrada $entrada, EntradaRepository $er): Response
    {
        $entrada = $er->findOneBy(['linkRoute' => $entrada->getLinkRoute()]);
        if (!$entrada) {
            throw $this->createNotFoundException(sprintf('No se encontró la entrada "%s"', $entrada));
        }

        return $this->render('entrada/link.html.twig', [
            'entrada' => $entrada,
        ]);
    }



    /**
     * @Route("/count/{id}/like", name="entrada_toggle_like", methods={"POST"})
     *
     * @return JsonResponse
     */
    public function toggleArticleHeart(Entrada $entrada, EntityManagerInterface $em)
    {
        $entrada->incrementaLikeCount();
        $em->flush();

        return new JsonResponse(['like' => $entrada->getLikes()]);
    }
}
