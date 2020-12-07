<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Entity\Principal;
use App\Repository\PrincipalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
//            return $this->render('inicio/temporalmente.html.twig', [
//                'datosIndex' => null,
//            ]);
        }


        return $this->render('inicio/index.html.twig', [
            'controller_name' => 'InicioController',
            'datosIndex' => $indexAlameda[0],
        ]);
    }

    /**
     * @Route("/ingreso", name="app_ingreso")
     * @param AuthenticationUtils $authenticationUtils
     * @return RedirectResponse
     */
    public function ingreso(AuthenticationUtils $authenticationUtils)
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
    public function test_index()
    {
        $em = $this->getDoctrine()->getManager();
        /** @var IndexAlameda $indexAlameda */
        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();

        return $this->render('inicio/index.html.twig', [
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

        return $this->render('inicio/'.$vista.'.html.twig', [
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
//        $ppal = $principalRepository->findOneBy(['principal'=>$principal->getId()]);

        $vista =$principal->getModelTemplate();
        if(!$vista) {
            $vista = ($principal->getPrincipal() ? $principal->getPrincipal()->getLinkRoute() : $principal->getLinkRoute());
        }
        $visual = $principalRepository->findOneBy(['principal'=>$principal->getId(), 'isActive'=>true]);
        if(!$visual){
            $visual = $principal;
        }

        return $this->render('inicio/'.$vista.'.html.twig', [
            'principal' => $visual,
        ]);
    }

    /**
     * @Route("/{id}", name="principal_show", methods={"GET"})
     * @param Principal $principal
     * @return Response
     */
    public function show(Principal $principal): Response
    {
        $vista = $principal->getLinkRoute();

        return $this->render($vista.'.html.twig', [
            'principal' => $principal,
        ]);
    }



    /**
     * @Route("/contacto", name="contacto")
     */
    public function contacto()
    {
        return $this->render('inicio/contacto.html.twig', []);
    }

    /**
     * @Route("/avanza", name="avanza")
     */
    public function avanza()
    {
        return $this->render('inicio/avanza.html.twig', []);
    }

    /**
     * @Route("/grupospequeños", name="grupospequeños", options = {"utf8": true })
     */
    public function gpc()
    {
        return $this->render('inicio/grupospequeños.html.twig', []);
    }

    /**
     * @Route("/ofrenda", name="ofrenda", options = {"utf8": true })
     */
    public function ofrenda()
    {
        return $this->render('inicio/ofrenda.html.twig', []);
    }

    /**
     * @Route("/notas", name="notas", options = {"utf8": true })
     */
    public function notas()
    {
        return $this->render('inicio/notas.html.twig', []);
    }

    /**
     * @Route("/oracion", name="oracion", options = {"utf8": true })
     */
    public function oracion()
    {
        return $this->render('inicio/oracion.html.twig', []);
    }
}
