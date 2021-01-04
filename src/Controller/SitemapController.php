<?php

namespace App\Controller;

use App\Entity\Principal;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $hostname = $request->getSchemeAndHttpHost();

        $urls = [];

// On ajoute les URLs "statiques"
        $urls[] = ['loc' => $this->generateUrl('reserva_index')];
        $urls[] = ['loc' => $this->generateUrl('app_login')];

        foreach ($this->getDoctrine()->getRepository(Principal::class)->findAll() as $principal) {
            $urls[] = [
                'loc' => $this->generateUrl('principal_ver', [
                    'linkRoute' => $principal->getLinkRoute(),
                ]),
                'lastmod' => $principal->getUpdatedAt()->format('Y-m-d'),
            ];
        }

        $response = new Response(
            $this->renderView('sitemap/index.html.twig', ['urls' => $urls,
                'hostname' => $hostname]),
            200
        );

        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}
