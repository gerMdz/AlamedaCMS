<?php

namespace App\Controller;

use App\Entity\Celebracion;
use App\Form\CelebracionType;
use App\Form\GroupCelebrationAddType;
use App\Repository\CelebracionRepository;
use App\Repository\GroupCelebrationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

/**
 * @Route("/admin/celebracion")
 * @IsGranted("ROLE_RESERVA")
 */
class CelebracionController extends AbstractController
{
    /**
     * @Route("/", name="celebracion_index", methods={"GET"})
     * @param CelebracionRepository $celebracionRepository
     * @return Response
     */
    public function index(CelebracionRepository $celebracionRepository): Response
    {
        return $this->render('celebracion/index.html.twig', [
            'celebracions' => $celebracionRepository->findAllByFechaCelebracion(),
        ]);
    }

    /**
     * @Route("/new", name="celebracion_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $celebracion = new Celebracion();
        $form = $this->createForm(CelebracionType::class, $celebracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $ahora = new DateTime('now');
            $hasta = $form['disponibleHastaAt']->getData();

            $celebracion->setDisponibleHastaAt($ahora->modify('+1 hour'));
            if ($hasta){
                $celebracion->setDisponibleHastaAt($hasta);
            }
            $celebracion->setCreaEvento($user);
            $celebracion->setCreatedAt($ahora);
            $celebracion->setUpdatedAt($ahora);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($celebracion);
            $entityManager->flush();

            return $this->redirectToRoute('celebracion_index');
        }

        return $this->render('celebracion/new.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="celebracion_show", methods={"GET"})
     * @param Celebracion $celebracion
     * @return Response
     */
    public function show(Celebracion $celebracion): Response
    {
        return $this->render('celebracion/show.html.twig', [
            'celebracion' => $celebracion,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="celebracion_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Celebracion $celebracion
     * @return Response
     */
    public function edit(Request $request, Celebracion $celebracion): Response
    {
        $form = $this->createForm(CelebracionType::class, $celebracion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('celebracion_index');
        }

        return $this->render('celebracion/edit.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="celebracion_delete", methods={"DELETE"})
     * @param Request $request
     * @param Celebracion $celebracion
     * @return Response
     */
    public function delete(Request $request, Celebracion $celebracion): Response
    {
        if ($this->isCsrfTokenValid('delete'.$celebracion->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($celebracion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('celebracion_index');
    }

    /**
     * @Route("/agregarGrupo/{id}", name="celebracion_agregar_grupo", methods={"GET", "POST"})
     * @param Request $request
     * @param Celebracion $celebracion
     * @param EntityManagerInterface $em
     * @param GroupCelebrationRepository $groupCelebrationRepository
     * @return RedirectResponse|Response
     */
    public function agregarGrupo(Request $request, Celebracion $celebracion, EntityManagerInterface $em, GroupCelebrationRepository $groupCelebrationRepository)
    {
        $form = $this->createForm(GroupCelebrationAddType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $id_grupo = $form->get('groupCelebration')->getData();
            $grupo = $groupCelebrationRepository->find($id_grupo);
            $celebracion->addGroupCelebration($grupo);
            $em->persist($celebracion);
            $em->flush();

            return $this->redirectToRoute('celebracion_index', [

            ]);
        }

        return $this->render('group_celebration/vistaAgregaGrupo.html.twig', [
            'celebracion' => $celebracion,
            'form' => $form->createView(),
        ]);

    }
}
