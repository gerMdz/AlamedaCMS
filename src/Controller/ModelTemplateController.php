<?php

namespace App\Controller;

use App\Entity\ModelTemplate;
use App\Form\ModelTemplateType;
use App\Repository\ModelTemplateRepository;
use App\Repository\TypeBlockRepository;
use Doctrine\ORM\EntityManagerInterface;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * @Route("/admin/modeltemplate")
 */
class ModelTemplateController extends AbstractController
{
    /**
     * @Route("/", name="model_template_index", methods={"GET"})
     * @param ModelTemplateRepository $modelTemplateRepository
     * @return Response
     */
    public function index(ModelTemplateRepository $modelTemplateRepository): Response
    {
        return $this->render('model_template/index.html.twig', [
            'model_templates' => $modelTemplateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="model_template_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $modelTemplate = new ModelTemplate();
        $form = $this->createForm(ModelTemplateType::class, $modelTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
     * @Route("/{id}", name="model_template_show", methods={"GET"})
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
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, ModelTemplate $modelTemplate): Response
    {
        $form = $this->createForm(ModelTemplateType::class, $modelTemplate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
        if ($this->isCsrfTokenValid('delete'.$modelTemplate->getId(), $request->request->get('_token'))) {
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
    public function registerTemplate(string $pathTemplate, TypeBlockRepository $blockRepository,ModelTemplateRepository $modelTemplateRepository, EntityManagerInterface $em): JsonResponse
    {
        $loader = $pathTemplate .'/modelEntrada';
        $finder = new Finder();
        $finder->in($loader);
        $finder->files()->name('*.twig');
        $temp = [];
        foreach ($finder as $load){
            $explodurl = explode($loader,$load->getPathname());
            $string = end($explodurl);
            $string = str_replace("/", '', $string);
            $explodstring = explode('.',$string);
            $data = $explodstring[0];
            $mt = $modelTemplateRepository->findBy(['identifier'=>$data]);
            if(!$mt){

            $template = new ModelTemplate();
            $block = $blockRepository->findBy(['identifier'=>'entrada']);
            $template->setBlock($block[0]);
            $template->setDescription($string);
            $template->setName($string);
            $template->setIdentifier($data);

                $em->persist($template);
                $em->flush();
            }else{
                $string = $string . " ya existe";
            }


            array_push($temp, $string  ) ;
        }


        return new JsonResponse($temp);

    }
}
