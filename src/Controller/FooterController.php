<?php

namespace App\Controller;

use App\Entity\Section;
use App\Repository\BlocsFixesRepository;
use App\Repository\PrincipalRepository;
use App\Repository\SourceApiRepository;
use App\Service\Handler\SourceApi\HandlerSourceApi;
use Doctrine\ORM\NonUniqueResultException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class FooterController extends AbstractController
{

    public function __construct(private readonly HandlerSourceApi $api)
    {
    }

    #[Route('/z_footer', name: 'app_footer')]
    public function index(): Response
    {
        return $this->render('footer/index.html.twig', [
            'controller_name' => 'FooterController',
        ]);
    }

    /**
     * @throws NonUniqueResultException
     */
    #[Route('/z_footer_show', name: 'app_footer_show')]
    public function show(
        Request $request, PrincipalRepository $principalRepository,
        BlocsFixesRepository $blocsFixesRepository, SourceApiRepository $sourceApiRepository): Response
    {
        $model = null;
        $response_api = null;
        $entradas = null;
        $apiSource = null;
        $section = null;
        $principal = substr($request->attributes->get('principal'), 1);
        if($principal){
            $principal = $principalRepository->findOneBy(['linkRoute' => $principal])->getId();
        }

        $footer = $blocsFixesRepository->getBlockFooterPrincipal($principal);

        if(!$footer){
            $footer = $blocsFixesRepository->getBlockFooterIndex();
        }

        if($footer){
            /** @var Section $section */
            $section = $footer->getSection()[0];
        }



        if($section){

            $twig = $section->getModelTemplate().'.html.twig';
            $model = 'models/sections/'.$twig;
            $entradas = $section->getEntradas();

            if ('api.html.twig' == $twig) {
                try {
                    $apiSource = $sourceApiRepository->findBy([
                        'identifier' => $section->getIdentificador(),
                    ]);
                } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
                }
                if ($apiSource) {
                    try {
                        $response_api = $this->api->fetchSourceApi($apiSource[0])[0];
                        $response_api['source'] = $apiSource[0]->getBaseUri();
                    } catch (ClientExceptionInterface|DecodingExceptionInterface|ServerExceptionInterface|TransportExceptionInterface|RedirectionExceptionInterface) {
                    }
                }
            }
        }
        if(!$model){
            $model = 'inicio/_footer_default.html.twig';
        }


        return $this->render($model, [
            'entradas' => $entradas,
            'section' => $section,
            'response_api' => $response_api,
        ]);
    }
}
