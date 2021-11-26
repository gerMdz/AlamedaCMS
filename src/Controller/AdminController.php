<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Entity\Section;
use App\Repository\EntradaRepository;
use App\Repository\MetaBaseRepository;
use App\Repository\PrincipalRepository;
use App\Repository\SectionRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
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

    /**
     * @Route("/admin/consulta-entradas-nuevas", name="admin_entradas_nuevas")
     * @param EntradaRepository $entradaRepository
     * @param SectionRepository $sectionRepository
     * @param PrincipalRepository $principalRepository
     * @param Request $request
     * @return JsonResponse
     */
    public function consultaEntradasNuevas(
        EntradaRepository $entradaRepository,
        SectionRepository $sectionRepository,
        PrincipalRepository $principalRepository,
        Request $request
    ): JsonResponse {

        $fecha_final = new DateTime('now');
        $fecha = clone $fecha_final;
        $fecha_inicial = $fecha->modify("-7 days");
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
                    'principales'=>$principales], 200, [], [
                'groups' => ['mail'],
            ]
        )
        ;
    }
}
