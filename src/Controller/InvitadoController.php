<?php

namespace App\Controller;

use App\Entity\Invitado;
use App\Form\InvitadoType;
use App\Repository\CelebracionRepository;
use App\Repository\InvitadoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/admin/invitado')]
#[IsGranted('ROLE_RESERVA')]
class InvitadoController extends AbstractController
{
    #[Route(path: '/', name: 'invitado_index', methods: ['GET'])]
    public function index(InvitadoRepository $invitadoRepository, PaginatorInterface $paginator, Request $request, CelebracionRepository $celebracionRepository): Response
    {
        $q = $request->query->get('c');
        $busq = $request->query->get('busq');
        $celebracion = null;
        if (isset($q)) {
            $celebracion = $celebracionRepository->find($q);
        }
        $queryBuilder = $invitadoRepository->searchQueryBuilder($q, $busq);
        $invitados = $paginator->paginate(
            $queryBuilder, /* query NOT result */
            $request->query->getInt('page', 1)/* page number */,
            20/* limit per page */
        );

        return $this->render('invitado/index.html.twig', [
            'invitados' => $invitados,
            'celebracion' => $celebracion,
        ]);
    }

    /**
     * @return JsonResponse
     */
    #[Route(path: '/update_ausente', name: 'invitado_update_ausente', methods: ['GET'])]
    public function updateAusente(Request $request, InvitadoRepository $invitadoRepository, EntityManagerInterface $entityManager)
    {
        $q = $request->query->get('c');
        $invitados = $invitadoRepository->getAusentesCelebracion($q);
        foreach ($invitados as $invitado) {
            /* @var Invitado $invitado */
            $invitado->setIsPresente(false);
            $entityManager->persist($invitado);
        }
        $entityManager->flush();
        $ausentes = $invitadoRepository->countAusentesByCelebracion($q);

        return new JsonResponse(['ausentes' => $ausentes]);
    }

    #[Route(path: '/new', name: 'invitado_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $invitado = new Invitado();
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($invitado);
            $entityManager->flush();

            return $this->redirectToRoute('invitado_index');
        }

        return $this->render('invitado/new.html.twig', [
            'invitado' => $invitado,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'invitado_show', methods: ['GET'])]
    public function show(Invitado $invitado): Response
    {
        return $this->render('invitado/show.html.twig', [
            'invitado' => $invitado,
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'invitado_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Invitado $invitado, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(InvitadoType::class, $invitado);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('invitado_index');
        }

        return $this->render('invitado/edit.html.twig', [
            'invitado' => $invitado,
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'invitado_delete', methods: ['DELETE'])]
    public function delete(Request $request, Invitado $invitado, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$invitado->getId(), $request->request->get('_token'))) {
            $entityManager->remove($invitado);
            $entityManager->flush();
        }

        return $this->redirectToRoute('invitado_index');
    }

    /**
     * @return JsonResponse
     */
    #[Route(path: '/cambia_presente', name: 'cambia_presente', methods: ['GET', 'POST'])]
    public function cambiaPresente(Request $request, InvitadoRepository $invitadoRepository, EntityManagerInterface $em)
    {
        $id = $request->get('id');
        $invitado = $invitadoRepository->find($id);
        $invitado->setIsPresente(!$invitado->getIsPresente());
        $em->persist($invitado);
        $em->flush();

        return new JsonResponse(['presente' => $invitado->getIsPresente()]);
    }
}
