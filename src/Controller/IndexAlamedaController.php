<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Form\IndexAlamedaType;
use App\Form\IndexSectionType;
use App\Repository\IndexAlamedaRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route(path: '/index/alameda')]
#[IsGranted('ROLE_ADMIN')]
class IndexAlamedaController extends AbstractController
{
    #[Route(path: '/', name: 'index_alameda_index', methods: ['GET'])]
    public function index(IndexAlamedaRepository $indexAlamedaRepository): Response
    {
        return $this->render('index_alameda/index.html.twig', [
            'index_alamedas' => $indexAlamedaRepository->findBy(['base' => 'index']),
            //            'datosIndex' => $indexAlamedaRepository->findAll()[0],
        ]);
    }

    #[Route(path: '/new', name: 'index_alameda_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $indexAlameda = new IndexAlameda();
        $form = $this->createForm(IndexAlamedaType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($indexAlameda);
            $entityManager->flush();

            return $this->redirectToRoute('index_alameda_index');
        }

        return $this->render('index_alameda/new.html.twig', [
            'index_alameda' => $indexAlameda,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'index_alameda_show', methods: ['GET'])]
    public function show(IndexAlameda $indexAlameda): Response
    {
        return $this->render('index_alameda/show.html.twig', [
            'index_alameda' => $indexAlameda,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'index_alameda_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, IndexAlameda $indexAlameda): Response
    {
        $form = $this->createForm(IndexAlamedaType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->container->get('doctrine')->getManager()->flush();

            return $this->redirectToRoute('index_alameda_index');
        }

        return $this->render('index_alameda/edit.html.twig', [
            'index_alameda' => $indexAlameda,
            'datosIndex' => $indexAlameda,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'index_alameda_delete', methods: ['DELETE'])]
    public function delete(Request $request, IndexAlameda $indexAlameda, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $indexAlameda->getId(), $request->request->get('_token'))) {
            $entityManager->remove($indexAlameda);
            $entityManager->flush();
        }

        return $this->redirectToRoute('index_alameda_index');
    }

    #[Route(path: '/admin/index/section/{id}', name: 'admin_index_list_section', methods: 'GET')]
    public function getSectionPrincipal(IndexAlameda $indexAlameda): JsonResponse
    {
        return $this->json(
            $indexAlameda->getSection(),
            200,
            [],
            [
                'groups' => ['main'],
            ]
        );
    }

    #[Route(path: '/admin/index/section/{id}/reorder', name: 'admin_principal_reorder_section', methods: 'POST')]
    public function reorderPrincipalSections(IndexAlameda $indexAlameda, EntityManagerInterface $entityManager,
                                             Request      $request): JsonResponse
    {
        $orderedIds = json_decode($request->getContent(), true);

        if (null === $orderedIds) {
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
                'groups' => ['main'],
            ]
        );
    }

    /**
     * @param Request $request
     * @param IndexAlameda $indexAlameda
     * @param EntityManagerInterface $entityManager
     * @param SectionRepository $sectionRepository
     * @param IndexAlamedaRepository $indexAlamedaRepository
     * @return RedirectResponse|Response
     */
    #[Route(path: '/agregarSeccion/{id}', name: 'index_agregar_seccion', methods: ['GET', 'POST'])]
    public function agregarSeccion(Request                $request, IndexAlameda $indexAlameda,
                                   EntityManagerInterface $entityManager, SectionRepository $sectionRepository,
                                   IndexAlamedaRepository $indexAlamedaRepository): RedirectResponse|Response
    {
        $form = $this->createForm(IndexSectionType::class, $indexAlameda);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id_section = $form->get('section')->getData();
            $seccion = $sectionRepository->find($id_section);
            $indexAlameda->addSection($seccion);
            $entityManager->persist($indexAlameda);
            $entityManager->flush();

            return $this->redirectToRoute('index_alameda_index', [
                'index_alamedas' => $indexAlamedaRepository->findAll(),
                'datosIndex' => $indexAlamedaRepository->findAll()[0],
            ]);
        }

        return $this->render('index_alameda/vistaAgregaSection.html.twig', [
            'index' => $indexAlameda,
            'form' => $form,
        ]);
    }
}
