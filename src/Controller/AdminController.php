<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Repository\EntradaRepository;
use App\Repository\MetaBaseRepository;
use App\Repository\PrincipalRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\Query\QueryException;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
    public function index(PrincipalRepository $principalRepository, MetaBaseRepository $metaBaseRepository, PaginatorInterface $paginator, Request $request): Response
    {
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
     * @throws QueryException
     */
    public function consultaEntradasNuevas(EntradaRepository $entradaRepository, SectionRepository $sectionRepository,Request $request)
    {

        $entradas = $entradaRepository->entradasByDateAndActiveAndModification();
        $notSections = [];
        /** @var Entrada $e */
        foreach ($entradas as $e){
            foreach ($e->getSections() as $s){
                array_push($notSections, $s->getId());
            }
        }
        $sectionRepository->sectionByDateAndActiveAndModification(null, null, $notSections);

    }
}
