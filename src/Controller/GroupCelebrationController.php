<?php

namespace App\Controller;

use App\Entity\GroupCelebration;
use App\Form\CelebrationAddType;
use App\Form\GroupCelebrationType;
use App\Repository\CelebracionRepository;
use App\Repository\GroupCelebrationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/grupoCelebracion')]
class GroupCelebrationController extends AbstractController
{
    #[Route(path: '/', name: 'group_celebration_index', methods: ['GET'])]
    public function index(GroupCelebrationRepository $groupCelebrationRepository): Response
    {
        return $this->render('group_celebration/index.html.twig', [
            'group_celebrations' => $groupCelebrationRepository->findAll(),
        ]);
    }

    #[Route(path: '/new', name: 'group_celebration_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $groupCelebration = new GroupCelebration();
        $form = $this->createForm(GroupCelebrationType::class, $groupCelebration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($groupCelebration);
            $entityManager->flush();

            return $this->redirectToRoute('group_celebration_index');
        }

        return $this->render('group_celebration/new.html.twig', [
            'group_celebration' => $groupCelebration,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'group_celebration_show', methods: ['GET'])]
    public function show(GroupCelebration $groupCelebration): Response
    {
        return $this->render('group_celebration/show.html.twig', [
            'group_celebration' => $groupCelebration,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'group_celebration_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GroupCelebration $groupCelebration, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GroupCelebrationType::class, $groupCelebration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('group_celebration_index');
        }

        return $this->render('group_celebration/edit.html.twig', [
            'group_celebration' => $groupCelebration,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}/remove/{celebracion}', name: 'group_celebration_remove_celebracion', methods: ['GET', 'POST'])]
    public function removeCelebracion(Request                $request, GroupCelebration $groupCelebration,
                                      CelebracionRepository  $celebracionRepository,
                                      EntityManagerInterface $entityManager): Response
    {
        $id_celebracion = $request->get('celebracion');
        $celebracion = $celebracionRepository->find($id_celebracion);

        $groupCelebration->removeCelebracione($celebracion);

        $entityManager->flush();

        return $this->render('group_celebration/show.html.twig', [
            'group_celebration' => $groupCelebration,
        ]);
    }

    #[Route(path: '/{id}', name: 'group_celebration_delete', methods: ['DELETE'])]
    public function delete(Request                $request, GroupCelebration $groupCelebration,
                           EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $groupCelebration->getId(), $request->request->get('_token'))) {
            $entityManager->remove($groupCelebration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('group_celebration_index');
    }

    /**
     * @return RedirectResponse|Response
     */
    #[Route(path: '/agregarCelebracion/{id}', name: 'grupo_agregar_celebracion', methods: ['GET', 'POST'])]
    public function agregarCelebracion(Request $request, GroupCelebration $groupCelebration, EntityManagerInterface $em, GroupCelebrationRepository $groupCelebrationRepository, CelebracionRepository $celebracionRepository)
    {
        $form = $this->createForm(CelebrationAddType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id_celebracion = $form->get('celebration')->getData();
            $celebracion = $celebracionRepository->find($id_celebracion);
            $celebracion->addGroupCelebration($groupCelebration);
            $em->persist($celebracion);
            $em->flush();

            return $this->redirectToRoute('group_celebration_show', [
                'id' => $groupCelebration->getId(),
            ]);
        }

        return $this->render('celebracion/vistaAgregaCelebracion.html.twig', [
            'group_celebration' => $groupCelebration,
            'form' => $form,
        ]);
    }
}
