<?php

namespace App\Controller;

use App\Entity\ItemMenu;
use App\Form\ItemMenuType;
use App\Repository\ItemMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/item/menu")
 */
class ItemMenuController extends AbstractController
{
    /**
     * @Route("/", name="app_item_menu_index", methods={"GET"})
     */
    public function index(ItemMenuRepository $itemMenuRepository): Response
    {
        return $this->render('item_menu/index.html.twig', [
            'item_menus' => $itemMenuRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_item_menu_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $itemMenu = new ItemMenu();
        $form = $this->createForm(ItemMenuType::class, $itemMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($itemMenu);
            $entityManager->flush();

            return $this->redirectToRoute('app_item_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('item_menu/new.html.twig', [
            'item_menu' => $itemMenu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_item_menu_show", methods={"GET"})
     */
    public function show(ItemMenu $itemMenu): Response
    {
        return $this->render('item_menu/show.html.twig', [
            'item_menu' => $itemMenu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_item_menu_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ItemMenu $itemMenu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ItemMenuType::class, $itemMenu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_item_menu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('item_menu/edit.html.twig', [
            'item_menu' => $itemMenu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_item_menu_delete", methods={"POST"})
     */
    public function delete(Request $request, ItemMenu $itemMenu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$itemMenu->getId(), $request->request->get('_token'))) {
            $entityManager->remove($itemMenu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_item_menu_index', [], Response::HTTP_SEE_OTHER);
    }
}
