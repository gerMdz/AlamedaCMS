<?php

namespace App\Controller;

use App\Entity\GroupCelebration;
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
     * @Route("/{id}", name="group_celebration_delete", methods={"DELETE"})
     * @param Request $request
     * @param GroupCelebration $groupCelebration
     * @return Response
     */
    public function delete(Request $request, GroupCelebration $groupCelebration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupCelebration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($groupCelebration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('group_celebration_index');
    }


}
