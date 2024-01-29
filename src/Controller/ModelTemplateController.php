<?php

namespace App\Controller;

use App\Entity\ModelTemplate;
use App\Form\ModelTemplateType;
use App\Repository\ModelTemplateRepository;
use App\Repository\TypeBlockRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/modeltemplate')]
class ModelTemplateController extends AbstractController
{
    /**
     * ModelTemplateController constructor.
     */
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    #[Route(path: '/', name: 'model_template_index', methods: ['GET'])]
    public function index(ModelTemplateRepository $modelTemplateRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $modelTemplate = $modelTemplateRepository->findAllModelTemplates();
        $modelTemplates = $paginator->paginate(
            $modelTemplate, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            20/* limit per page */
        );

        return $this->render('model_template/index.html.twig', [
            'model_templates' => $modelTemplates,
        ]);
    }

    #[Route(path: '/{block}', name: 'model_template_index_block', methods: ['GET'])]
    public function indexBlock(ModelTemplateRepository $modelTemplateRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $block = $request->get('block');
        $modelTemplate = $modelTemplateRepository->findModelTemplatesByBlock($block);

        $modelTemplates = $paginator->paginate(
            $modelTemplate, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            20/* limit per page */
        );

        return $this->render('model_template/index.html.twig', [
            'model_templates' => $modelTemplates,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/new', name: 'model_template_new', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function new(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager): Response
    {
        $modelTemplate = new ModelTemplate();
        $form = $this->createForm(ModelTemplateType::class, $modelTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var ModelTemplate $modelTemplate */
            $modelTemplate = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $modelTemplate->setImageFilename($newFilename);
            }
            $entityManager->persist($modelTemplate);
            $entityManager->flush();

            return $this->redirectToRoute('model_template_index');
        }

        return $this->render('model_template/new.html.twig', [
            'model_template' => $modelTemplate,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}/show', name: 'model_template_show', methods: ['GET'])]
    public function show(ModelTemplate $modelTemplate): Response
    {
        return $this->render('model_template/show.html.twig', [
            'model_template' => $modelTemplate,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[Route(path: '/{id}/edit', name: 'model_template_edit', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, ModelTemplate $modelTemplate, UploaderHelper $uploaderHelper,
        EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModelTemplateType::class, $modelTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, $modelTemplate->getImageFilename());
                $modelTemplate->setImageFilename($newFilename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('model_template_index');
        }

        return $this->render('model_template/edit.html.twig', [
            'model_template' => $modelTemplate,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'model_template_delete', methods: ['DELETE'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, ModelTemplate $modelTemplate,
        EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modelTemplate->getId(), $request->request->get('_token'))) {
            $entityManager->remove($modelTemplate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('model_template_index');
    }

    #[Route(path: '/registerTemplate/all', name: 'register_template', methods: ['GET', 'POST'])]
    public function registerTemplate(string $pathTemplate, TypeBlockRepository $blockRepository, ModelTemplateRepository $modelTemplateRepository, EntityManagerInterface $em): JsonResponse
    {
        $models = [
            $pathTemplate.'/modelEntrada' => 'entrada',
            $pathTemplate.'/sections' => 'seccion',
            $pathTemplate.'/models/principal' => 'page',
            $pathTemplate.'/models/sections' => 'seccion',
            $pathTemplate.'/models/entradas' => 'entrada',
        ];
        $temp = [];
        foreach ($models as $key => $value) {
            $finder = new Finder();
            $finder->in($key);
            $finder->files()->name('*.twig');

            foreach ($finder as $load) {
                $explodurl = explode($key, $load->getPathname());
                $string = end($explodurl);
                $string = str_replace('/', '', $string);
                $explodstring = explode('.', $string);
                $data = $explodstring[0];
                $mt = $modelTemplateRepository->findBy(['identifier' => $data]);
                if (!$mt) {
                    $template = new ModelTemplate();
                    $block = $blockRepository->findBy(['identifier' => $value]);
                    $template->setBlock($block[0]);
                    $template->setDescription($string);
                    $template->setName($string);
                    $template->setIdentifier($data);

                    $em->persist($template);
                    $em->flush();
                } else {
                    $string = $string.' ya existe';
                }

                array_push($temp, $string);
            }
        }

        return new JsonResponse($temp);
    }

    #[Route(path: 'createBlockFromModelTemplate/{id}', name: 'model_template_create_block', methods: ['GET', 'POST'])]
    public function createBlockFromModelTemplate(ModelTemplate $modelTemplate): RedirectResponse
    {
        $this->requestStack->getSession()->set('model_template_id', $modelTemplate->getId());
        $entity = $modelTemplate->getBlock()->getEntity();

        return $this->redirectToRoute(sprintf('admin_%s_new_step1', strtolower($entity)));
    }
}
