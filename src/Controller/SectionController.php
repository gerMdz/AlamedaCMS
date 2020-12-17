<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Entity\EntradaReference;
use App\Entity\IndexAlameda;
use App\Entity\Section;
use App\Form\SectionFormType;
use App\Repository\EntradaRepository;
use App\Repository\SectionRepository;
use App\Service\Mailer;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SectionController
 * @package App\Controller
 * @Route("/admin/section")
 */
class SectionController extends BaseController
{
    /**
     * @param SectionRepository $repository
     * @Route("/", name="admin_section_list")
     * @return Response
     */
    public function list(SectionRepository $repository)
    {
        return $this->render('section_admin/list.html.twig', [
            'sections' => $repository->findAll()
        ]);
    }

    /**
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @throws Exception
     * @Route("/new", name="admin_section_new")
     * @IsGranted("ROLE_EDITOR")
     */
    public function new(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper)
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
            $em->persist($section);
            $em->flush();

            $this->addFlash('success', 'Sección creada. Gracias por su contribución');

            return $this->redirectToRoute('admin_section_list');
        }
        return $this->render('section_admin/new.html.twig', [
            'sectionForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_section_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Section $section
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @IsGranted("MANAGE", subject="section")
     * @throws Exception
     */
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
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_section_list');
        }

        return $this->render('section_admin/edit.html.twig', [
            'section' => $section,
            'sectionForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/typeorigin-select", name="admin_section_typeorigin_select", methods={"GET" })
     * @param Request $request
     * @return Response
     * @IsGranted("ROLE_EDITOR")
     */
    public function getTypoSecondarySelect(Request $request)
    {
        // Asegurando endpoint
        if (!$this->isGranted('ROLE_ADMIN') && $this->getUser()->getSections()->isEmpty()) {
            throw $this->createAccessDeniedException();
        }
        $section = new Section();
        $section->setTypeOrigin($request->query->get('typeOrigin'));
        $form = $this->createForm(SectionFormType::class, $section);
        if (!$form->has('typeSecondary')) {
            return new Response(null, 204);
        }
        return $this->render('section_admin/_typeSecondary.html.twig', [
            'sectionForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/index/{id}", name="admin_index_delete_section", methods={"DELETE"})
     * @param Section $section
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function deleteIndexSection(Section $section, EntityManagerInterface $entityManager)
    {
        $indexAlameda = $section->getIndexAlamedas();

        $section->removeIndexAlameda($indexAlameda[0]);

        $entityManager->flush();
        return new Response(null, 204);
    }

    /**
     * @Route("/muestra/seccion/{id}")
     * @param Section $section
     * @param EntradaRepository $entradaRepository
     * @return Response
     * @throws QueryException
     */
    public function mostrarSection(Section $section, EntradaRepository $entradaRepository): Response
    {

        $entradas = $entradaRepository->findAllEntradasBySeccion($section->getId());

//        if($section->getOrden() == 1){
//            dd($section);
//        }




        $twig = $section->getModelTemplate().".html.twig";
        return $this->render('sections/'.$twig,[
           'entradas' => $entradas,
            'section' => $section
        ]);
    }


}
