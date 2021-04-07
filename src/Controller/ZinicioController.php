<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Entity\Principal;
use App\Repository\PrincipalRepository;
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
     * @var bool
     */
    private $site_temporal;

    /**
     * ZinicioController constructor.
     * @param string $site_temporal
     */
    public function __construct(string $site_temporal)
    {
        $this->site_temporal = $site_temporal;
    }

    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        /** @var IndexAlameda $indexAlameda */
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();
        if($this->site_temporal == 'true'){
            return $this->redirectToRoute('reserva_index');
//            return $this->render('models/principal/temporalmente.html.twig', [
//                'datosIndex' => null,
//            ]);
        }


        return $this->render('models/principal/index.html.twig', [
            'controller_name' => 'InicioController',
            'datosIndex' => $indexAlameda[0],
        ]);
    }

    /**
     * @Route("/ingreso", name="app_ingreso")
     * @param AuthenticationUtils $authenticationUtils
     * @return RedirectResponse
     */
    public function ingreso(AuthenticationUtils $authenticationUtils): RedirectResponse
    {
        return $this->redirectToRoute('app_login');
    }

    /**
     * @Route("/reserva", name="app_reserva")
     * @return RedirectResponse
     */
    public function app_reserva(): RedirectResponse
    {
        return $this->redirectToRoute('reserva_index');
    }

    /**
     * @Route("/test/index", name="test_index")
     */
    public function test_index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        /** @var IndexAlameda $indexAlameda */
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();

        return $this->render('models/principal/index.html.twig', [
            'controller_name' => 'InicioController',
            'datosIndex' => $indexAlameda[0],
        ]);
    }

    /**
     * @Route("/test/{linkRoute}", name="test_principal_ver", methods={"GET"})
     * @param Principal $principal
     * @param PrincipalRepository $principalRepository
     * @return Response
     */
    public function ver_test(Principal $principal, PrincipalRepository $principalRepository): Response
    {
//        $ppal = $principalRepository->findOneBy(['principal'=>$principal->getId()]);

        $vista =$principal->getModelTemplate();
        if(!$vista) {
            $vista = ($principal->getPrincipal() ? $principal->getPrincipal()->getLinkRoute() : $principal->getLinkRoute());
        }
        $visual = $principalRepository->findOneBy(['principal'=>$principal->getId(), 'isActive'=>true]);
        if(!$visual){
            $visual = $principal;
        }

        return $this->render('models/principal/'.$vista.'.html.twig', [
            'principal' => $visual,
        ]);
    }

    /**
     * @Route("/{linkRoute}", name="principal_ver", methods={"GET"})
     * @param Principal $principal
     * @param PrincipalRepository $principalRepository
     * @return Response
     */
    public function ver(Principal $principal, PrincipalRepository $principalRepository): Response
    {

        $vista =$principal->getModelTemplate();
        if(!$vista) {
            $vista = ($principal->getPrincipal() ? $principal->getPrincipal()->getLinkRoute() : $principal->getLinkRoute());
        }
        $visual = $principalRepository->findOneBy(['principal'=>$principal->getId(), 'isActive'=>true]);
        if(!$visual){
            $visual = $principal;
        }

        return $this->render('models/principal/'.$vista.'.html.twig', [
            'principal' => $visual,
        ]);
    }

    /**
     * @Route("/{linkRoute}/listado", name="principal_listado", methods={"GET"})
     * @param Principal $principal
     * @param PrincipalRepository $principalRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function listado(Principal $principal, PrincipalRepository $principalRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $query = $principalRepository->getQueryfindByPrincipalParentActive($principal);

        $principales = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );


        return $this->render('models/principal/listadoPrincipal.html.twig', [
            'principales' => $principales,
            'ppal' => $principal
        ]);
    }


    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto()
    {
        return $this->render('models/principal/contacto.html.twig', []);
    }

    /**
     * @Route("/avanza", name="avanza")
     */
    public function avanza()
    {
        return $this->render('models/principal/avanza.html.twig', []);
    }

    /**
     * @Route("/grupospequeños", name="grupospequeños", options = {"utf8": true })
     */
    public function gpc()
    {
        return $this->render('models/principal/grupospequeños.html.twig', []);
    }

    /**
     * @Route("/ofrenda", name="ofrenda", options = {"utf8": true })
     */
    public function ofrenda()
    {
        return $this->render('models/principal/ofrenda.html.twig', []);
    }

    /**
     * @Route("/notas", name="notas", options = {"utf8": true })
     */
    public function notas(): Response
    {
        return $this->render('models/principal/notas.html.twig', []);
    }

    /**
     * @Route("/oracion", name="oracion", options = {"utf8": true })
     */
    public function oracion()
    {
        return $this->render('models/principal/oracion.html.twig', []);
    }
}
