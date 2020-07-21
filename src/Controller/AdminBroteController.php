<?php

namespace App\Controller;

use App\Entity\Brote;
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
        $brote = new Brote();
        $user = $this->getUser();
        $brote->setAutor($user);

        $form = $this->createForm(BroteType::class, $brote);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Brote $brote */
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
            $brote->setPublicadoAt($publicado);

            $em->persist($brote);
            $em->flush();

            $this->addFlash('success', 'Se agregó brote a link principal');

            return $this->redirectToRoute('admin_brote');
        }

        return $this->render('admin_brote/new.html.twig', [
            'broteForm' => $form->createView(),
            'brote' => $brote,
        ]);
    }

    /**
     * @Route("/admin/brote", name="admin_brote")
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
