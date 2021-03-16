<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Entity\Invitado;
use App\Entity\Section;
use App\Form\IndexAlamedaType;
use App\Form\IndexSectionType;
use App\Form\InvitadoType;
use App\Repository\IndexAlamedaRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/index/alameda")
 * @IsGranted("ROLE_ADMIN")
 */
class IndexAlamedaController extends AbstractController
{
    /**
     * @Route("/", name="index_alameda_index", methods={"GET"})
     * @param IndexAlamedaRepository $indexAlamedaRepository
     * @return Response
     */
    public function index(IndexAlamedaRepository $indexAlamedaRepository): Response
    {
//        $em = $this->getDoctrine()->getManager();
//        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();

        return $this->render('index_alameda/index.html.twig', [
            'index_alamedas' => $indexAlamedaRepository->findAll(),
            'datosIndex' => $indexAlamedaRepository->findAll()[0],
        ]);
    }

    /**
     * @Route("/new", name="index_alameda_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $indexAlameda = new IndexAlameda();
        $form = $this->createForm(IndexAlamedaType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($indexAlameda);
            $entityManager->flush();

            return $this->redirectToRoute('index_alameda_index');
        }

        return $this->render('index_alameda/new.html.twig', [
            'index_alameda' => $indexAlameda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="index_alameda_show", methods={"GET"})
     * @param IndexAlameda $indexAlameda
     * @return Response
     */
    public function show(IndexAlameda $indexAlameda): Response
    {
        return $this->render('index_alameda/show.html.twig', [
            'index_alameda' => $indexAlameda,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="index_alameda_edit", methods={"GET","POST"})
     * @param Request $request
     * @param IndexAlameda $indexAlameda
     * @return Response
     */
    public function edit(Request $request, IndexAlameda $indexAlameda): Response
    {
        $form = $this->createForm(IndexAlamedaType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('index_alameda_index');
        }

        return $this->render('index_alameda/edit.html.twig', [
            'index_alameda' => $indexAlameda,
            'datosIndex' => $indexAlameda,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="index_alameda_delete", methods={"DELETE"})
     * @param Request $request
     * @param IndexAlameda $indexAlameda
     * @return Response
     */
    public function delete(Request $request, IndexAlameda $indexAlameda): Response
    {
        if ($this->isCsrfTokenValid('delete'.$indexAlameda->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($indexAlameda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index_alameda_index');
    }

    /**
     * @Route("/admin/index/section/{id}", methods="GET", name="admin_index_list_section")
     * @param IndexAlameda $indexAlameda
     * @return JsonResponse
     */
    public function getSectionPrincipal(IndexAlameda $indexAlameda): JsonResponse
    {
        return $this->json(
            $indexAlameda->getSection(),
            200,
            [],
            [
                'groups' => ['main']
            ]
        );
    }

    /**
     * @Route("/admin/index/section/{id}/reorder", methods="POST", name="admin_principal_reorder_section")
     * @param IndexAlameda $indexAlameda
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return JsonResponse
     */
    public function reorderPrincipalSections(IndexAlameda $indexAlameda, EntityManagerInterface $entityManager, Request $request)
    {
        $orderedIds = json_decode($request->getContent(), true);

        if ($orderedIds === null) {
            return $this->json(['detail' => 'Datos Inválidos'], 400);
        }

        // from (position)=>(id) to (id)=>(position)
        $orderedIds = array_flip($orderedIds);

        foreach ($indexAlameda->getSection() as $reference) {
            $reference->setOrden($orderedIds[$reference->getId()]);
        }

        $entityManager->flush();

        return $this->json(
            $indexAlameda->getSection(),
            200,
            [],
            [
                'groups' => ['main']
            ]
        );
    }

    /**
     * @Route("/agregarSeccion/{id}", name="index_agregar_seccion", methods={"GET", "POST"})
     * @param Request $request
     * @param IndexAlameda $indexAlameda
     * @param EntityManagerInterface $entityManager
     * @param SectionRepository $sectionRepository
     * @param IndexAlamedaRepository $indexAlamedaRepository
     * @return RedirectResponse|Response
     */
    public function agregarSeccion(Request $request, IndexAlameda $indexAlameda, EntityManagerInterface $entityManager, SectionRepository $sectionRepository, IndexAlamedaRepository $indexAlamedaRepository)
    {
        $form = $this->createForm(IndexSectionType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $id_section = $form->get('section')->getData();
            $seccion = $sectionRepository->find($id_section);
            $indexAlameda->addSection($seccion);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($indexAlameda);
            $entityManager->flush();

            return $this->redirectToRoute('index_alameda_index', [
                'index_alamedas' => $indexAlamedaRepository->findAll(),
                'datosIndex' => $indexAlamedaRepository->findAll()[0],
            ]);
        }

        return $this->render('index_alameda/vistaAgregaSection.html.twig', [
            'index' => $indexAlameda,
            'form' => $form->createView(),
        ]);

    }


}
