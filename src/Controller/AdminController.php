<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Entity\Section;
use App\Repository\EntradaRepository;
use App\Repository\MetaBaseRepository;
use App\Repository\PrincipalRepository;
use App\Repository\SectionRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin/general', name: 'admin')]
    public function index(
        PrincipalRepository $principalRepository,
        MetaBaseRepository $metaBaseRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $bus = $request->get('busq');

        $queryPrincipales = $principalRepository->queryFindAllPrincipals($bus);
        $principales = $paginator->paginate(
            $queryPrincipales, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            20/* limit per page */
        );

        //        if ($this->isGranted('ROLE_ADMIN')) {
        return $this->render('admin/index.html.twig', [
            'principals' => $principales,
            'meta_bases' => $metaBaseRepository->findAll(),
        ]);
        //        }

        //        return $this->render('admin/index_escritor.html.twig', [
        //            'principals' => $principales,
        //        ]);
    }

    #[Route(path: '/admin', name: 'app_admin_main')]
    public function main(
        MetaBaseRepository $metaBaseRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $bus = $request->get('busq');

        //        if ($this->isGranted('ROLE_ADMIN')) {
        return $this->render('admin/main.html.twig', [
            'meta_bases' => $metaBaseRepository->findAll(),
        ]);
        //        }

        //        return $this->render('admin/index_escritor.html.twig', [
        //            'principals' => $principales,
        //        ]);
    }

    #[Route(path: '/admin/consulta-entradas-nuevas', name: 'admin_entradas_nuevas')]
    public function consultaEntradasNuevas(
        EntradaRepository $entradaRepository,
        SectionRepository $sectionRepository,
        PrincipalRepository $principalRepository
    ): JsonResponse {
        $fecha_final = new \DateTime('now');
        $fecha = clone $fecha_final;
        $fecha_inicial = $fecha->modify('-7 days');
        //        $entradas = $entradaRepository->entradasByDateAndActiveAndModification($fecha_inicial, $fecha_final)->getQuery(
        //        )->getResult();
        //
        //        $notSections = [];
        //        /** @var Entrada $e */
        //        foreach ($entradas as $e) {
        //            foreach ($e->getSections() as $s) {
        //                array_push($notSections, $s->getId());
        //            }
        //        }
        //        $secciones = $sectionRepository->sectionByDateAndActiveAndModification(
        //            $fecha_inicial,
        //            $fecha_final,
        //            $notSections
        //        )->getQuery()->getResult();
        //
        //        $notPrincipals = [];
        //        /** @var Section $s */
        //        foreach ($secciones as $s) {
        //            foreach ($s->getPrincipales() as $p) {
        //                array_push($notPrincipals, $p->getId());
        //            }
        //        }
        $principales = $principalRepository->principalByDateAndActiveAndModification(
            $fecha_inicial,
            $fecha_final,
            $notPrincipals = null
        )->getQuery()->getResult();

        return
            $this->json(
                [
//                    'entradas'=>$entradas,
//                    'secciones' => $secciones,
                    'principales' => $principales], 200, [], [
                'groups' => ['mail'],
            ]
            )
        ;
    }
}
