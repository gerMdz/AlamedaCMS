<?php

namespace App\Controller;

use App\Entity\Principal;
use App\Form\PrincipalType;
use App\Form\SectionAddType;
use App\Repository\PrincipalRepository;
use App\Repository\SectionRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[\Symfony\Component\Routing\Attribute\Route(path: '/admin/principal')]
class PrincipalController extends BaseController
{
    public function __construct(private readonly RequestStack $requestStack)
    {
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/', name: 'principal_index', methods: ['GET'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function index(PrincipalRepository $principalRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $bus = $request->get('busq');
        $queryPrincipales = $principalRepository->queryFindAllPrincipals($bus);
        $principales = $paginator->paginate(
            $queryPrincipales, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            15/* limit per page */
        );

        return $this->render('principal/index.html.twig', [
            'principals' => $principales,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[\Symfony\Component\Routing\Attribute\Route(path: '/new', name: 'principal_new', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function new(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager): Response
    {
        $principal = new Principal();
        $user = $this->getUser();
        $ahora = new \DateTime('now');
        $principal->setAutor($user);
        $principal->setCreatedAt($ahora);
        $principal->setUpdatedAt($ahora);
        $form = $this->createForm(PrincipalType::class, $principal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Principal $principal */
            $principal = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            $linkRoute = $form['linkRoute']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $principal->setImageFilename($newFilename);
            }
            if (null != $principal->getLinkRoute()) {
                $principal->setLinkRoute($principal->getLinkRoute());
            } else {
                $principal->setLinkRoute($principal->getTitulo());
            }
            $entityManager->persist($principal);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('principal/new.html.twig', [
            'principal' => $principal,
            'form' => $form,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[\Symfony\Component\Routing\Attribute\Route(path: '/new-for-assistant', name: 'principal_new_assistant', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function newAssistant(Request $request, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager): Response
    {
        $principal = new Principal();
        $user = $this->getUser();
        $ahora = new \DateTime('now');
        $principal->setAutor($user);
        $principal->setCreatedAt($ahora);
        $principal->setUpdatedAt($ahora);
        $form = $this->createForm(PrincipalType::class, $principal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Principal $principal */
            $principal = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            $linkRoute = $form['linkRoute']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $principal->setImageFilename($newFilename);
            }
            if (null != $principal->getLinkRoute()) {
                $principal->setLinkRoute($principal->getLinkRoute());
            } else {
                $principal->setLinkRoute($principal->getTitulo());
            }
            $entityManager->persist($principal);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('principal/newAssistant.html.twig', [
            'principal' => $principal,
            'form' => $form,
        ]);
    }

    /**
     * @throws \Exception
     */
    #[\Symfony\Component\Routing\Attribute\Route(path: '/{id}/edit', name: 'principal_edit', methods: ['GET', 'POST'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Principal $principal, UploaderHelper $uploaderHelper,
        EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PrincipalType::class, $principal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            $linkRoute = $form['linkRoute']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, $principal->getImageFilename());
                $principal->setImageFilename($newFilename);
            }

            if ($linkRoute) {
                $principal->setLinkRoute($linkRoute);
            } else {
                $principal->setLinkRoute($principal->getTitulo());
            }

            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('principal/edit.html.twig', [
            'principal' => $principal,
            'form' => $form,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{id}/show', name: 'principal_show', methods: ['GET'])]
    public function show(Principal $principal, PrincipalRepository $repository): Response
    {
        $brotes = $repository->findByPrincipalParent($principal);
        if (!$brotes) {
            $brotes = null;
        }

        return $this->render('principal/show.html.twig', [
            'principal' => $principal,
            'brotes' => $brotes,
        ]);
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/{id}', name: 'principal_delete', methods: ['DELETE'])]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Principal $principal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$principal->getId(), $request->request->get('_token'))) {
            $entityManager->remove($principal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_index');
    }

    #[\Symfony\Component\Routing\Attribute\Route(path: '/section/{id}', methods: 'GET', name: 'admin_principal_list_section')]
    public function getSectionPrincipal(Principal $principal): JsonResponse
    {
        return $this->json(
            $principal->getSecciones(),
            200,
            [],
            [
                'groups' => ['main'],
            ]
        );
    }

    /**
     * @return RedirectResponse|Response
     */
    #[\Symfony\Component\Routing\Attribute\Route(path: '/agregarSeccion/{id}', name: 'principal_agregar_seccion', methods: ['GET', 'POST'])]
    public function agregarSeccion(Request $request, Principal $principal, EntityManagerInterface $entityManager, SectionRepository $sectionRepository, PrincipalRepository $principalRepository)
    {
        $form = $this->createForm(SectionAddType::class);
        $form->handleRequest($request);
        $this->requestStack->getSession()->set('principal_id', $principal->getId());

        if ($form->isSubmitted() && $form->isValid()) {
            $id_section = $form->get('section')->getData();
            $seccion = $sectionRepository->find($id_section);
            $principal->addSeccione($seccion);
            $entityManager->persist($principal);
            $entityManager->flush();

            if ($this->requestStack->getSession()->get('principal_id')) {
                $this->requestStack->getSession()->remove('principal_id');
            }

            return $this->redirectToRoute('principal_show', [
                'id' => $principal->getId(),
            ]);
        }

        return $this->render('principal/vistaAgregaSection.html.twig', [
            'principal' => $principal,
            'form' => $form,
        ]);
    }
}
