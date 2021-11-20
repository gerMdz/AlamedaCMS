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

/**
 * @Route("/entrada")
 */
class EntradaController extends AbstractController
{


    /**
     * @Route("/{linkRoute}", name="entrada_ver", methods={"GET"})
     *
     * @param Entrada $entrada
     * @param EntradaRepository $er
     * @return Response
     */
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


    /**
     * @Route("/count/{id}/like", name="entrada_toggle_like", methods={"POST"})
     *
     * @param Entrada $entrada
     * @param EntityManagerInterface $em
     * @return JsonResponse
     */
    public function toggleArticleHeart(Entrada $entrada, EntityManagerInterface $em): JsonResponse
    {
        $entrada->incrementaLikeCount();
        $em->flush();

        return new JsonResponse(['like' => $entrada->getLikes()]);
    }

    /**
     * @Route("/admin/entrada/section/{id}", methods="GET", name="admin_entrada_list_section")
     * @param Entrada $entrada
     * @return JsonResponse
     */
    public function getSectionPrincipal(Entrada $entrada): JsonResponse
    {
        return $this->json(
            $entrada->getSections(),
            200,
            [],
            [
                'groups' => ['main']
            ]
        );
    }

    /**
     * @Route("/agregarSeccion/{id}", name="entrada_agregar_seccion", methods={"GET", "POST"})
     * @param Request $request
     * @param Entrada $entrada
     * @param SectionRepository $sectionRepository
     * @return RedirectResponse|Response
     */
    public function agregarSeccion(Request $request, Entrada $entrada, SectionRepository $sectionRepository)
    {
        $form = $this->createForm(EntradaSectionType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $id_section = $form->get('section')->getData();
            $seccion = $sectionRepository->find($id_section);
            $entrada->addSection($seccion);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin_entrada/vistaAgregaSection.html.twig', [
            'index' => $entrada,
            'form' => $form->createView(),
        ]);
    }
}
