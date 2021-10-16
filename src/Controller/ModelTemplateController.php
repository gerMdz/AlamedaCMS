<?php

namespace App\Controller;

use App\Entity\ModelTemplate;
use App\Form\ModelTemplateType;
use App\Repository\ModelTemplateRepository;
use App\Repository\TypeBlockRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/modeltemplate")
 */
class ModelTemplateController extends AbstractController
{

    private $session;

    /**
     * ModelTemplateController constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="model_template_index", methods={"GET"})
     * @param ModelTemplateRepository $modelTemplateRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(ModelTemplateRepository $modelTemplateRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $modelTemplate = $modelTemplateRepository->findAllModelTemplates();
        $modelTemplates = $paginator->paginate(
            $modelTemplate, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('model_template/index.html.twig', [
            'model_templates' => $modelTemplates,
        ]);
    }

    /**
     * @Route("/{block}", name="model_template_index_block", methods={"GET"})
     * @param ModelTemplateRepository $modelTemplateRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function indexBlock(ModelTemplateRepository $modelTemplateRepository,Request $request, PaginatorInterface $paginator): Response
    {
        $block = $request->get('block');
        $modelTemplate = $modelTemplateRepository->findModelTemplatesByBlock($block);

        $modelTemplates = $paginator->paginate(
            $modelTemplate, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('model_template/index.html.twig', [
            'model_templates' => $modelTemplates,
        ]);
    }

    /**
     * @Route("/new", name="model_template_new", methods={"GET","POST"})
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
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
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($modelTemplate);
            $entityManager->flush();

            return $this->redirectToRoute('model_template_index');
        }

        return $this->render('model_template/new.html.twig', [
            'model_template' => $modelTemplate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="model_template_show", methods={"GET"})
     * @param ModelTemplate $modelTemplate
     * @return Response
     */
    public function show(ModelTemplate $modelTemplate): Response
    {
        return $this->render('model_template/show.html.twig', [
            'model_template' => $modelTemplate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="model_template_edit", methods={"GET","POST"})
     * @param Request $request
     * @param ModelTemplate $modelTemplate
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, ModelTemplate $modelTemplate, UploaderHelper $uploaderHelper): Response
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
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('model_template_index');
        }

        return $this->render('model_template/edit.html.twig', [
            'model_template' => $modelTemplate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="model_template_delete", methods={"DELETE"})
     * @param Request $request
     * @param ModelTemplate $modelTemplate
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, ModelTemplate $modelTemplate): Response
    {
        if ($this->isCsrfTokenValid('delete' . $modelTemplate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($modelTemplate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('model_template_index');
    }

    /**
     * @Route("/registerTemplate/all", name="register_template", methods={"GET", "POST"})
     * @param string $pathTemplate
     * @param TypeBlockRepository $blockRepository
     * @param ModelTemplateRepository $modelTemplateRepository
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function registerTemplate(string $pathTemplate, TypeBlockRepository $blockRepository, ModelTemplateRepository $modelTemplateRepository, EntityManagerInterface $em): JsonResponse
    {
        $models = [
            $pathTemplate . '/modelEntrada' => 'entrada',
            $pathTemplate . '/sections' => 'seccion',
            $pathTemplate . '/models/principal' => 'page',
            $pathTemplate . '/models/sections' => 'seccion',
            $pathTemplate . '/models/entradas' => 'entrada'
        ];
        $temp = [];
        foreach ($models  as $key => $value){
            $finder = new Finder();
            $finder->in($key);
            $finder->files()->name('*.twig');

            foreach ($finder as $load) {
                $explodurl = explode($key, $load->getPathname());
                $string = end($explodurl);
                $string = str_replace("/", '', $string);
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
                    $string = $string . " ya existe";
                }


                array_push($temp, $string);
            }

        }

        return new JsonResponse($temp);

    }

    /**
     * @Route("createBlockFromModelTemplate/{id}", name="model_template_create_block", methods={"GET", "POST"})
     * @param ModelTemplate $modelTemplate
     * @return RedirectResponse
     */
    public function createBlockFromModelTemplate(ModelTemplate $modelTemplate): RedirectResponse
    {
        $this->session->set('model_template_id', $modelTemplate->getId());
        $entity = $modelTemplate->getBlock()->getEntity();
        return $this->redirectToRoute(sprintf('admin_%s_new_step1', strtolower($entity) ));
    }
}
