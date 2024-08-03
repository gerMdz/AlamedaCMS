<?php

namespace App\Controller;

use App\Entity\BlocsFixes;
use App\Form\BlocsFixesType;
use App\Repository\BlocsFixesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route(path: '/admin/blocsfixes')]
class BlocsFixesController extends AbstractController
{
    #[Route(path: '/', name: 'app_blocs_fixes_index', methods: ['GET'])]
    public function index(BlocsFixesRepository $blocsFixesRepository, Request $request): Response
    {
        $bus = $request->get('busq');
        $blocs_fixes = $blocsFixesRepository->queryAllBlocsFixes($bus)->getQuery()->getResult();

        return $this->render('admin/blocs_fixes/index.html.twig', [
            'blocs_fixes' => $blocs_fixes,
        ]);
    }

    #[Route(path: '/new', name: 'app_blocs_fixes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BlocsFixesRepository $blocsFixesRepository): Response
    {
        $blocsFix = new BlocsFixes();
        $form = $this->createForm(BlocsFixesType::class, $blocsFix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blocsFixesRepository->add($blocsFix);

            return $this->redirectToRoute('app_blocs_fixes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/blocs_fixes/new.html.twig', [
            'blocs_fix' => $blocsFix,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'app_blocs_fixes_show', methods: ['GET'])]
    public function show(BlocsFixes $blocsFix): Response
    {
        return $this->render('admin/blocs_fixes/show.html.twig', [
            'blocs_fix' => $blocsFix,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'app_blocs_fixes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BlocsFixes $blocsFix, BlocsFixesRepository $blocsFixesRepository): Response
    {
        $form = $this->createForm(BlocsFixesType::class, $blocsFix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blocsFixesRepository->add($blocsFix);

            return $this->redirectToRoute('app_blocs_fixes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/blocs_fixes/edit.html.twig', [
            'blocs_fix' => $blocsFix,
            'form' => $form,
        ]);
    }

    #[Route(path: '/{id}', name: 'app_blocs_fixes_delete', methods: ['POST'])]
    public function delete(Request $request, BlocsFixes $blocsFix, BlocsFixesRepository $blocsFixesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blocsFix->getId(), $request->request->get('_token'))) {
            $blocsFixesRepository->remove($blocsFix);
        }

        return $this->redirectToRoute('app_blocs_fixes_index', [], Response::HTTP_SEE_OTHER);
    }
}
