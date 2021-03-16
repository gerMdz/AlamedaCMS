<?php

namespace App\Controller;

use App\Entity\Brote;
use App\Entity\Principal;
use App\Form\BroteType;
use App\Repository\BroteRepository;
use App\Service\BoleanToDateHelper;
use App\Service\LoggerClient;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;

class AdminBroteController extends AbstractController
{
    private $isDebug;
    private $loggerClient;
    private $boleanToDateHelper;

    /**
     * NO usado es opcional.
     * @param bool $isDebug
     * @param LoggerClient $loggerClient
     * @param BoleanToDateHelper $boleanToDateHelper
     */
    public function __construct(bool $isDebug, LoggerClient $loggerClient, BoleanToDateHelper $boleanToDateHelper)
    {
        $this->isDebug = $isDebug;
        $this->loggerClient = $loggerClient;
        $this->boleanToDateHelper = $boleanToDateHelper;
    }

    /**
     * @Route("/admin/brote/new", name="admin_brote_new")
     * @IsGranted("ROLE_ESCRITOR")
     *
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function new(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper)
    {
        $brote = new Principal();
        $user = $this->getUser();
        $brote->setAutor($user);

        $form = $this->createForm(BroteType::class, $brote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Principal $brote */
            $brote = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            $link = $form['linkRoute']->getData();
            $titulo = $form['titulo']->getData();

            if ('' != $link) {
                $link = strtolower(str_replace(' ', '-', trim($link)));
            } else {
                $link = strtolower(str_replace(' ', '-', trim($titulo)));
            }
            $brote->setLinkRoute($link);

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $brote->setImageFilename($newFilename);
            }

            $boolean = $form['publicar']->getData();

            $publicado = $this->boleanToDateHelper->setDatatimeForTrue($boolean);
            $brote->setCreatedAt($publicado);

            $em->persist($brote);
            $em->flush();

            $this->addFlash('success', 'Se agregó brote a link principal');

            return $this->redirectToRoute('admin_brote_list');
        }

        return $this->render('admin_brote/new.html.twig', [
            'broteForm' => $form->createView(),
            'brote' => $brote,
        ]);
    }

    /**
     * @Route("/admin/brote/{linkRoute}/edit", name="admin_brote_edit")
     * @IsGranted("ROLE_ESCRITOR")
     * @param Brote $brote
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UploaderHelper $uploaderHelper
     * @return RedirectResponse|Response
     * @throws Exception
     */
    public function edit(Brote $brote, Request $request, EntityManagerInterface $em, UploaderHelper $uploaderHelper)
    {
        $form = $this->createForm(BroteType::class, $brote);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $boolean = $form['publicar']->getData();
            $publicado = $this->boleanToDateHelper->setDatatimeForTrue($boolean);
            $brote->setPublicadoAt($publicado);

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $brote->setImageFilename($newFilename);
            }



            $em->persist($brote);
            $em->flush();
            $this->addFlash('success', 'Elemento Actualizado');
            return $this->redirectToRoute('admin_brote_edit', [
                'linkRoute'=>$brote->getLinkRoute()
            ]);
        }
        return $this->render('admin_brote/edit.html.twig', [
            'broteForm' => $form->createView(),
            'brote' => $brote
        ]);
    }

    /**
     * @Route("/admin/brote", name="admin_brote_list")
     * @param BroteRepository $broteRepository
     * @return Response
     */
    public function list(BroteRepository $broteRepository): Response
    {
        return $this->render('admin_brote/index.html.twig', [
            'brotes' => $broteRepository->findAll(),
        ]);
    }
}
