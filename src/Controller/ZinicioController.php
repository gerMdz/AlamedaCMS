<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Entity\Principal;
use App\Repository\PrincipalRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ZinicioController extends AbstractController
{
    /**
     * ZinicioController constructor.
     */
    public function __construct(private readonly string $site_temporal)
    {
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/', name: 'index')]
    public function index(EntityManagerInterface $em)
    {
        /** @var IndexAlameda $indexAlameda */
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findOneBy(['base' => 'index']);
        if ('true' == $this->site_temporal) {
            return $this->redirectToRoute('reserva_index');
            //            return $this->render('models/principal/temporalmente.html.twig', [
            //                'datosIndex' => null,
            //            ]);
        }
        $vista = 'index';
        if ($indexAlameda->getTemplate()) {
            $vista = $indexAlameda->getTemplate();
        }

        $blocsFixes = $indexAlameda->getBlocsFixes() ?? [];

        return $this->render('models/principal/'.$vista.'.html.twig', [
            'controller_name' => 'InicioController',
            'datosIndex' => $indexAlameda,
            'blocsFixes' => $blocsFixes,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/ingreso', name: 'app_ingreso')]
    public function ingreso(AuthenticationUtils $authenticationUtils): RedirectResponse
    {
        return $this->redirectToRoute('app_login');
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/reserva', name: 'app_reserva')]
    public function app_reserva(): RedirectResponse
    {
        return $this->redirectToRoute('reserva_index');
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/test/index', name: 'test_index')]
    public function test_index(): Response
    {
        $em = $this->container->get('doctrine')->getManager();
        /** @var IndexAlameda $indexAlameda */
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();
        //        $blocsFixes = $em->getRepository(BlocsFixes::class)->findBy(['indexAlameda' => $indexAlameda[0]->getId()]);
        $blocsFixes = $indexAlameda[0]->getBlocsFixes();

        return $this->render('models/principal/index-side-right.html.twig', [
            'controller_name' => 'InicioController',
            'datosIndex' => $indexAlameda[0],
            'blocsFixes' => $blocsFixes,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/test/{linkRoute}', name: 'test_principal_ver', methods: ['GET'])]
    public function ver_test(Principal $principal, PrincipalRepository $principalRepository): Response
    {
        $vista = $principal->getModelTemplate();
        if (!$vista) {
            $vista = ($principal->getPrincipal() ? $principal->getPrincipal()->getLinkRoute(
            ) : $principal->getLinkRoute());
        }
        $visual = $principalRepository->findOneBy(['principal' => $principal->getId(), 'isActive' => true]);
        if (!$visual) {
            $visual = $principal;
        }

        return $this->render('models/principal/'.$vista.'.html.twig', [
            'principal' => $visual,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{linkRoute}', name: 'principal_ver', methods: ['GET'])]
    public function ver(
        Principal $principal,
        PrincipalRepository $principalRepository,
        SectionRepository $sectionRepository
    ): Response {
        $vista = $principal->getModelTemplate();
        if (!$vista) {
            $vista = ($principal->getPrincipal() ? $principal->getPrincipal()->getLinkRoute(
            ) : $principal->getLinkRoute());
        }
        $visual = $principalRepository->findOneBy(['principal' => $principal->getId(), 'isActive' => true]);
        if (!$visual) {
            $visual = $principal;
        }
        $secciones = $sectionRepository->queryFindSectionsByPrincipal($principal->getId())->getQuery()->getResult();

        return $this->render('models/principal/'.$vista.'.html.twig', [
            'principal' => $visual,
            'secciones' => $secciones,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{linkRoute}/listado', name: 'principal_listado', methods: ['GET'])]
    public function listado(
        Principal $principal,
        PrincipalRepository $principalRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $query = $principalRepository->getQueryfindByPrincipalParentActive($principal);

        $principales = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            5/* limit per page */
        );

        return $this->render('models/principal/listadoPrincipal.html.twig', [
            'principales' => $principales,
            'ppal' => $principal,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/contacto', name: 'contacto')]
    public function contacto(): Response
    {
        return $this->render('models/principal/contacto.html.twig', []);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/avanza', name: 'avanza')]
    public function avanza(): Response
    {
        return $this->render('models/principal/avanza.html.twig', []);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/grupospequeños', name: 'grupospequeños', options: ['utf8' => true])]
    public function gpc(): Response
    {
        return $this->render('models/principal/grupospequeños.html.twig', []);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/ofrenda', name: 'ofrenda', options: ['utf8' => true])]
    public function ofrenda(): Response
    {
        return $this->render('models/principal/ofrenda.html.twig', []);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/notas', name: 'notas', options: ['utf8' => true])]
    public function notas(): Response
    {
        return $this->render('models/principal/notas.html.twig', []);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/oracion', name: 'oracion', options: ['utf8' => true])]
    public function oracion(): Response
    {
        return $this->render('models/principal/oracion.html.twig', []);
    }
}
