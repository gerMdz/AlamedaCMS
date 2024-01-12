<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaSectionType;
use App\Repository\EntradaRepository;
use App\Repository\SectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/entrada')]
class EntradaController extends AbstractController
{
    #[Route(path: '/{linkRoute}', name: 'entrada_ver', methods: ['GET'])]
    public function ver(Entrada $entrada, EntradaRepository $er): Response
    {
        $entrada = $er->findOneBy(['linkRoute' => $entrada->getLinkRoute()]);
        if (!$entrada) {
            throw $this->createNotFoundException(sprintf('No se encontró la entrada "%s"', $entrada));
        }

        return $this->render('entrada/link.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    #[Route(path: '/count/{id}/like', name: 'entrada_toggle_like', methods: ['POST'])]
    public function toggleArticleHeart(Entrada $entrada, EntityManagerInterface $em): JsonResponse
    {
        $entrada->incrementaLikeCount();
        $em->flush();

        return new JsonResponse(['like' => $entrada->getLikes()]);
    }

    #[Route(path: '/admin/entrada/section/{id}', methods: 'GET', name: 'admin_entrada_list_section')]
    public function getSectionPrincipal(Entrada $entrada): JsonResponse
    {
        return $this->json(
            $entrada->getSections(),
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
    #[Route(path: '/agregarSeccion/{id}', name: 'entrada_agregar_seccion', methods: ['GET', 'POST'])]
    public function agregarSeccion(Request $request, Entrada $entrada, SectionRepository $sectionRepository,
                                   EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(EntradaSectionType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id_section = $form->get('section')->getData();
            $seccion = $sectionRepository->find($id_section);
            $entrada->addSection($seccion);
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin/entrada/vistaAgregaSection.html.twig', [
            'index' => $entrada,
            'form' => $form->createView(),
        ]);
    }
}
