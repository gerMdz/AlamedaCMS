<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaType;
use App\Repository\EntradaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Gedmo\Sluggable\Util\Urlizer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEntradaController extends AbstractController
{
    /**
     * @Route("/admin/entrada", name="admin_entrada_index")
     * @param EntradaRepository $entradaRepository
     * @return Response
     * @IsGranted("ROLE_ESCRITOR")
     */
    public function index(EntradaRepository $entradaRepository): Response
    {
        return $this->render('admin_entrada/index.html.twig', [
            'entradas' => $entradaRepository->findAll(),
        ]);

    }

    /**
     * @param Request $request
     * @param Entrada $entrada
     * @return RedirectResponse
     * @Route("admin/entrada/{id}/edit", name="admin_entrada_edit")
     * @IsGranted("MANAGE", subject="entrada")
     */
    public function edit(Request $request, Entrada $entrada): Response{

        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $this->moveFile($uploadedFile, 'image_entrada');
                $entrada->setImageFilename($newFilename);
            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('entrada/edit.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
        ]);
    }



    /**
     * @Route("/admin/entrada/new", name="admin_entrada_new")
     * @IsGranted("ROLE_ESCRITOR")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(EntradaType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Entrada $entrada */
            $entrada = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $this->moveFile($uploadedFile, 'image_entrada');
                $entrada->setImageFilename($newFilename);
            }



            $em->persist($entrada);
            $em->flush();

            $this->addFlash('success', 'Se agregó una entrada al sitio');

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin_entrada/new.html.twig', [
            'entradaForm' => $form->createView()
        ]);
    }

    public function moveFile($uploadedFile, $destination){
        $destination = $this->getParameter('kernel.project_dir').'/public/uploads/'. $destination;
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename =  Urlizer::urlize($originalFilename).'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );
        return $newFilename;
    }
}
