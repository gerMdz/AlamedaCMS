<?php

namespace App\Controller;

use App\Entity\ModelTemplate;
use App\Entity\Principal;
use App\Form\PrincipalType;
use App\Form\SectionAddType;
use App\Repository\PrincipalRepository;
use App\Repository\SectionRepository;
use App\Service\UploaderHelper;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/principal")
 */
class PrincipalController extends BaseController
{
    /**
     * @Route("/", name="principal_index", methods={"GET"})
     * @param PrincipalRepository $principalRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(PrincipalRepository $principalRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $bus = $request->get('busq');
        $queryPrincipales = $principalRepository->queryFindAllPrincipals($bus);
        $principales = $paginator->paginate(
            $queryPrincipales, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            15/*limit per page*/
        );
        return $this->render('principal/index.html.twig', [
            'principals' => $principales,
        ]);
    }

    /**
     * @Route("/new", name="principal_new", methods={"GET","POST"})
     * @Route("/new_clone", name="principal_clone", methods={"GET","POST"})
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     * @throws Exception
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {
        $path = $request->getPathInfo();

        $principal = $this->dataPrincipal();
        $principal_clone = null;

        if ($path == "/admin/principal/new_clone")
        {
            $principal_clone = $this->getDoctrine()->getManager()->getRepository(Principal::class)->find($request->query->get('id_principal'));
            $principal->setModelTemplate($principal_clone->getModelTemplate());
            $principal->setCssClass($principal_clone->getCssClass());

            if($request->query->get('parent'))
            {
                $principal->setPrincipal($principal_clone);
            }
        }
        $form = $this->getDataForm($principal, $request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->procesaForm($form, $uploaderHelper, $principal_clone->getSecciones());
        }

        return $this->render('principal/new.html.twig', [
            'principal' => $principal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new-for-assistant", name="principal_new_assistant", methods={"GET","POST"})
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     * @throws Exception
     */
    public function newAssistant(Request $request, UploaderHelper $uploaderHelper): Response
    {

        $principal = $this->dataPrincipal();
        $form = $this->getDataForm($principal, $request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Principal $principal */
            return $this->procesaForm($form, $uploaderHelper);
        }

        return $this->render('principal/newAssistant.html.twig', [
            'principal' => $principal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="principal_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Principal $principal
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Principal $principal, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->getDataForm($principal, $request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            $linkRoute = $form['linkRoute']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, $principal->getImageFilename());
                $principal->setImageFilename($newFilename);
            }

            if($linkRoute){
                $principal->setLinkRoute($linkRoute);
            }else{
                $principal->setLinkRoute($principal->getTitulo());
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('principal/edit.html.twig', [
            'principal' => $principal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="principal_show", methods={"GET"})
     * @param Principal $principal
     * @param PrincipalRepository $repository
     * @return Response
     */
    public function show(Principal $principal, PrincipalRepository $repository): Response
    {
        $brotes = $repository->findByPrincipalParent($principal);
        if(!$brotes){
            $brotes = null;
        }
        return $this->render('principal/show.html.twig', [
            'principal' => $principal,
            'brotes' => $brotes
        ]);
    }

    /**
     * @Route("/{id}", name="principal_delete", methods={"DELETE"})
     * @param Request $request
     * @param Principal $principal
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Principal $principal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$principal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_index');
    }

    /**
     * @Route("/section/{id}", methods="GET", name="admin_principal_list_section")
     * @param Principal $principal
     * @return JsonResponse
     */
    public function getSectionPrincipal(Principal $principal): JsonResponse
    {
        return $this->json(
            $principal->getSecciones(),
            200,
            [],
            [
                'groups' => ['main']
            ]
        );
    }

    /**
     * @Route("/agregarSeccion/{id}", name="principal_agregar_seccion", methods={"GET", "POST"})
     * @param Request $request
     * @param Principal $principal
     * @param EntityManagerInterface $entityManager
     * @param SectionRepository $sectionRepository
     * @return RedirectResponse|Response
     */
    public function agregarSeccion(Request $request, Principal $principal, EntityManagerInterface $entityManager, SectionRepository $sectionRepository)
    {
        $form = $this->createForm(SectionAddType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $id_section = $form->get('section')->getData();
            $seccion = $sectionRepository->find($id_section);
            $principal->addSeccione($seccion);
            $entityManager->persist($principal);
            $entityManager->flush();

            return $this->redirectToRoute('principal_show', [
                'id' => $principal->getId(),
            ]);
        }

        return $this->render('principal/vistaAgregaSection.html.twig', [
            'principal' => $principal,
            'form' => $form->createView(),
        ]);

    }

    /**
     * @return Principal
     */
    public function dataPrincipal(): Principal
    {
        $principal = new Principal();
        $user = $this->getUser();
        $ahora = new DateTime('now');
        $principal->setAutor($user);
        $principal->setCreatedAt($ahora);
        $principal->setUpdatedAt($ahora);

        return $principal;
    }

    /**
     * @param Principal $principal
     * @param Request $request
     * @return FormInterface
     */
    public function getDataForm(Principal $principal, Request $request): FormInterface
    {
        $form = $this->createForm(PrincipalType::class, $principal);
        $form->handleRequest($request);

        return $form;
    }

    /**
     * @param FormInterface $form
     * @param UploaderHelper $uploaderHelper
     * @return RedirectResponse
     * @throws Exception
     */
    public function procesaForm(FormInterface $form, UploaderHelper $uploaderHelper, $secciones = null): RedirectResponse
    {
        /** @var Principal $principal */
        $principal = $form->getData();

        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $form['imageFile']->getData();

        if ($uploadedFile) {
            $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
            $principal->setImageFilename($newFilename);
        }
        if ($principal->getLinkRoute() == null) {
            $principal->setLinkRoute($principal->getTitulo());
        }


        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($principal);
        $entityManager->flush();
//        if($secciones){
//            dd($secciones);
//            foreach ($secciones as $seccion)
//            {
//                $principal->addSeccione($seccion);
//            }
//        }
        $entityManager->persist($principal);
        $entityManager->flush();

        return $this->redirectToRoute('admin');
    }
}
