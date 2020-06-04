<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Form\EntradaType;
use App\Repository\EntradaRepository;
use App\Service\LoggerClient;
use App\Service\ObtenerDatosHelper;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEntradaController extends AbstractController
{
    private $isDebug;

    private $loggerClient;

    /**
     * NO usado es opcional
     * @param bool $isDebug
     * @param LoggerClient $loggerClient
     */
    public function __construct(bool $isDebug, LoggerClient $loggerClient)
    {
        $this->isDebug = $isDebug;
        $this->loggerClient = $loggerClient;
    }

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
     * @param UploaderHelper $uploaderHelper
     * @param ObtenerDatosHelper $datosHelper
     * @return RedirectResponse
     * @Route("admin/entrada/{id}/edit", name="admin_entrada_edit")
     * @IsGranted("MANAGE", subject="entrada")
     */
    public function edit(Request $request, Entrada $entrada, UploaderHelper $uploaderHelper, ObtenerDatosHelper $datosHelper): Response
    {
        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile);
                $entrada->setImageFilename($newFilename);
            }


            $this->getDoctrine()->getManager()->flush();

            $this->loggerClient->logMessage('Se editó la entrada \"'. $entrada->getTitulo() . '\"', '');

            return $this->redirectToRoute('admin_entrada_index');
        }

        $ip = $datosHelper->getIpCliente();

        return $this->render('entrada/edit.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
            'ip'=>$ip
        ]);
    }

    /**
     * @Route("/admin/entrada/new", name="admin_entrada_new")
     * @IsGranted("ROLE_ESCRITOR")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return RedirectResponse|Response
     */
    public function new(EntityManagerInterface $em, Request $request, UploaderHelper $uploaderHelper)
    {
        $entrada = new Entrada();
        $user = $this->getUser();
        $entrada->setAutor($user);

        $form = $this->createForm(EntradaType::class, $entrada);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Entrada $entrada */
            $entrada = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile);
                $entrada->setImageFilename($newFilename);
            }

            $em->persist($entrada);
            $em->flush();

            $this->addFlash('success', 'Se agregó una entrada al sitio');

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin_entrada/new.html.twig', [
            'entradaForm' => $form->createView(),
            'entrada'=>$entrada
        ]);
    }
}
