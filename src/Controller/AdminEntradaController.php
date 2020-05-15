<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Repository\EntradaRepository;
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
     * @Route("/admin/entrada", name="admin_entrada")
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
     * @param Entrada $entrada
     * @Route("admin/entrada/{id}/edit", name="admin_entrada_edit")
     * @IsGranted("MANAGE", subject="entrada")
     * @return RedirectResponse
     */
    public function edit(Entrada $entrada){

//        Usesé en caso de que no sepamos que subjet se envía
//        $this->denyAccessUnlessGranted('ROLE_ADMIN_ENTRADAS', $entrada);
        return $this->redirectToRoute('entrada_edit',['id'=>$entrada->getId()]);
    }

    /**
     * @Route("/admin/upload/prueba" , name="upload_prueba")
     * @param Request $request
     */
    public function temporalUploadAction(Request $request){
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('image');
        $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
        dd($uploadedFile->move($destination));
    }
}
