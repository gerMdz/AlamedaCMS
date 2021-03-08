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

/**
 * @Route("/admin/grupoCelebracion")
 */
class GroupCelebrationController extends AbstractController
{
    /**
     * @Route("/", name="group_celebration_index", methods={"GET"})
     * @param GroupCelebrationRepository $groupCelebrationRepository
     * @return Response
     */
    public function index(GroupCelebrationRepository $groupCelebrationRepository): Response
    {
        return $this->render('group_celebration/index.html.twig', [
            'group_celebrations' => $groupCelebrationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="group_celebration_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $groupCelebration = new GroupCelebration();
        $form = $this->createForm(GroupCelebrationType::class, $groupCelebration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupCelebration);
            $entityManager->flush();

            return $this->redirectToRoute('group_celebration_index');
        }

        return $this->render('group_celebration/new.html.twig', [
            'group_celebration' => $groupCelebration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="group_celebration_show", methods={"GET"})
     * @param GroupCelebration $groupCelebration
     * @return Response
     */
    public function show(GroupCelebration $groupCelebration): Response
    {
        return $this->render('group_celebration/show.html.twig', [
            'group_celebration' => $groupCelebration,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="group_celebration_edit", methods={"GET","POST"})
     * @param Request $request
     * @param GroupCelebration $groupCelebration
     * @return Response
     */
    public function edit(Request $request, GroupCelebration $groupCelebration): Response
    {
        $form = $this->createForm(GroupCelebrationType::class, $groupCelebration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('group_celebration_index');
        }

        return $this->render('group_celebration/edit.html.twig', [
            'group_celebration' => $groupCelebration,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/remove/{celebracion}", name="group_celebration_remove_celebracion", methods={"GET","POST"})
     * @param Request $request
     * @param GroupCelebration $groupCelebration
     * @param CelebracionRepository $celebracionRepository
     * @return Response
     */
    public function removeCelebracion(Request $request, GroupCelebration $groupCelebration, CelebracionRepository $celebracionRepository): Response
    {
        $id_celebracion = $request->get('celebracion');
        $celebracion = $celebracionRepository->find($id_celebracion);

        $groupCelebration->removeCelebracione($celebracion);

        $this->getDoctrine()->getManager()->flush();


        return $this->render('group_celebration/show.html.twig', [
            'group_celebration' => $groupCelebration,
        ]);
    }

    /**
     * @Route("/{id}", name="group_celebration_delete", methods={"DELETE"})
     * @param Request $request
     * @param GroupCelebration $groupCelebration
     * @return Response
     */
    public function delete(Request $request, GroupCelebration $groupCelebration): Response
    {
        if ($this->isCsrfTokenValid('delete' . $groupCelebration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($groupCelebration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('group_celebration_index');
    }

    /**
     * @Route("/agregarCelebracion/{id}", name="grupo_agregar_celebracion", methods={"GET", "POST"})
     * @param Request $request
     * @param GroupCelebration $groupCelebration
     * @param EntityManagerInterface $em
     * @param GroupCelebrationRepository $groupCelebrationRepository
     * @param CelebracionRepository $celebracionRepository
     * @return RedirectResponse|Response
     */
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
                'id' => $groupCelebration->getId()
            ]);
        }

        return $this->render('celebracion/vistaAgregaCelebracion.html.twig', [
            'group_celebration' => $groupCelebration,
            'form' => $form->createView(),
        ]);

    }


}
