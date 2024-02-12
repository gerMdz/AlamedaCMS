<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Entity\Principal;
use App\Entity\Section;
use App\Entity\SourceApi;
use App\Form\EntradaSectionType;
use App\Form\SectionFormType;
use App\Form\Step\Section\StepOneType;
use App\Form\Step\Section\StepThreeType;
use App\Form\Step\Section\StepTwoType;
use App\Repository\EntradaRepository;
use App\Repository\ModelTemplateRepository;
use App\Repository\SectionRepository;
use App\Repository\SourceApiRepository;
use App\Service\Handler\SourceApi\HandlerSourceApi;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class SectionController.
 */
#[Route(path: '/admin/section')]
class SectionController extends BaseController
{



    /**
     * SectionController constructor.
     */
    public function __construct(private readonly RequestStack $requestStack, private readonly HandlerSourceApi $api,
                                private readonly ManagerRegistry $managerRegistry)
    {
    }

    #[Route(path: '/', name: 'admin_section_list')]
    public function list(SectionRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $bus = $request->get('busq');

        $seccion = $repository->getSections($bus);
        $secciones = $paginator->paginate(
            $seccion, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            20/* limit per page */
        );

        return $this->render('admin/section_admin/list.html.twig', [
            'sections' => $secciones,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/new', name: 'admin_section_new')]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_EDITOR')]
    public function new(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->createForm(SectionFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Section $section */
            $section = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $section->setImageFilename($newFilename);
            }

            if ($this->requestStack->getSession()->get('principal_id')) {
                $principal_id = $this->requestStack->getSession()->get('principal_id');
                $principal = $em->getRepository(Principal::class)->find($principal_id);
                if ($principal) {
                    $section->addPrincipale($principal);
                }
                $this->requestStack->getSession()->remove('principal_id');
            }

            $em->persist($section);
            $em->flush();

            $this->addFlash('success', 'Sección creada. Gracias por su contribución');

            return $this->redirectToRoute('admin_section_list');
        }

        return $this->render('admin/section_admin/new.html.twig', [
            'sectionForm' => $form,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/{id}/edit', name: 'admin_section_edit', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('MANAGE', subject: 'section')]
    public function edit(Request $request, Section $section, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->createForm(SectionFormType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, $section->getImageFilename());
                $section->setImageFilename($newFilename);
            }
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('admin_section_list');
        }

        return $this->render('admin/section_admin/edit.html.twig', [
            'section' => $section,
            'sectionForm' => $form,
        ]);
    }

    #[Route(path: '/index/{id}', name: 'admin_index_delete_section', methods: ['DELETE'])]
    public function deleteIndexSection(Section $section, EntityManagerInterface $entityManager): Response
    {
        $indexAlameda = $section->getIndexAlamedas();

        $section->removeIndexAlameda($indexAlameda[0]);

        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    #[Route(path: '/entrada/{id}/{entrada}', name: 'admin_entrada_delete_section', methods: ['DELETE'])]
    public function deleteEntradaSection(
        Section $section,
        Entrada $entrada,
        EntityManagerInterface $entityManager
    ): Response {
        $section->removeEntrada($entrada);

        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    #[Route(path: '/principal/{id}/{principal}', name: 'admin_principal_delete_section', methods: ['DELETE'])]
    public function deletePrincipalSection(
        Section $section,
        Principal $principal,
        EntityManagerInterface $entityManager
    ): Response {
        if (null !== $principal->getSecciones()) {
            $section->removePrincipale($principal);
        }

        $section->setPrincipal(null);
        $entityManager->flush();

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    #[Route(path: '/muestra/seccion/{id}')]
    public function mostrarSection(Section $section, EntradaRepository $entradaRepository, SourceApiRepository $sourceApiRepository): Response
    {
        $entradas = $entradaRepository->findAllEntradasBySeccion($section->getId());

        $twig = $section->getModelTemplate().'.html.twig';
        $response_api = null;
        $apiSource = null;

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
        $model = 'models/sections/'.$twig;

        return $this->render($model, [
            'entradas' => $entradas,
            'section' => $section,
            'response_api' => $response_api,
        ]);
    }

    #[Route(path: '/{id}', name: 'admin_section_show', methods: ['GET'])]
    public function show(Section $section): Response
    {
        return $this->render('admin/section_admin/show.html.twig', [
            'section' => $section,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/new/step1', name: 'admin_section_new_step1', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ESCRITOR')]
    public function newStepOne(Request $request): Response
    {
        $section = new Section();
        $form = $this->createForm(StepOneType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $principal = $form['principal']->getData();
            $section->addPrincipale($principal);

            $this->managerRegistry->getManager()->persist($section);
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('admin_section_new_step2', [
                'id' => $section->getId(),
            ]);
        }

        return $this->render('admin/section_admin/new_step1.html.twig', [
            'section' => $section,
            'sectionForm' => $form,
        ]);
    }

    #[Route(path: '/new/step2/{id}', name: 'admin_section_new_step2', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ESCRITOR')]
    public function newStepTwo(
        Request $request,
        Section $section,
        ModelTemplateRepository $modelTemplateRepository
    ): Response {
        $section->setTitle($section->getName());
        $form = $this->createForm(StepTwoType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $model_template_id = $this->requestStack->getSession()->get('model_template_id');
            if ($model_template_id) {
                $model_template = $modelTemplateRepository->find($model_template_id);
                if ($model_template) {
                    $section->setModelTemplate($model_template);
                }
                $this->requestStack->getSession()->remove('model_template_id');
            }
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('admin_section_new_step3', [
                'id' => $section->getId(),
            ]);
        }

        return $this->render('admin/section_admin/new_step2.html.twig', [
            'section' => $section,
            'sectionForm' => $form,
        ]);
    }

    #[Route(path: '/new/step3/{id}', name: 'admin_section_new_step3', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ESCRITOR')]
    public function newStepThree(Request $request, Section $section): Response
    {
        $section->setTitle($section->getName());
        $form = $this->createForm(StepThreeType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('admin_section_show', [
                'id' => $section->getId(),
            ]);
        }

        return $this->render('admin/section_admin/new_step3.html.twig', [
            'section' => $section,
            'sectionForm' => $form,
        ]);
    }

    #[Route(path: '/test/api/{identifier}', name: 'admin_section_test_api', methods: ['GET', 'POST'])]
    public function getDataSourceApi(SourceApi $api)
    {
        return new JsonResponse($this->api->fetchSourceApi($api));
    }

    /**
     * La idea es agregar una entrada ya creada a una sección, falta el modal que selecciona la entrada.
     *
     * @param Entrada $section
     *
     * @return RedirectResponse|Response
     */
    #[Route(path: '/agregarEntrada/{id}', name: 'section_agregar_entrada', methods: ['GET', 'POST'])]
    public function agregarSeccion(Request $request, Section $section, EntradaRepository $entradaRepository)
    {
        $form = $this->createForm(EntradaSectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id_section = $form->get('section')->getData();
            $seccion = $sectionRepository->find($id_section);
            $entrada->addSection($seccion);
            $entityManager = $this->managerRegistry->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin/entrada/vistaAgregaSection.html.twig', [
            'index' => $entrada,
            'form' => $form,
        ]);
    }
}
