<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Entity\EntradaReference;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EntradaReferenciaAdminController extends AbstractController
{
    /**
     * @Route("/admin/entrada/{id}/referencia", name="admin_entrada_add_referencia", methods={"POST"})
     * @IsGranted("MANAGE", subject="entrada")
     *
     * @param Entrada $entrada
     * @param Request $request
     * @param UploaderHelper $helper
     * @param EntityManagerInterface $em
     * @return RedirectResponse
     */
    public function uploadArticleReference(Entrada $entrada, Request $request, UploaderHelper $helper, EntityManagerInterface $em)
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('reference');
        $filename = $helper->uploadEntradaReference($uploadedFile);

        $entradaReference = new EntradaReference($entrada);
        $entradaReference->setFilename($filename);
        $entradaReference->setOrginalFilename($uploadedFile->getClientOriginalName() ?? $filename);
        $entradaReference->setMimeType($uploadedFile->getMimeType() ?? 'application/octet-stream');
        $em->persist($entradaReference);
        $em->flush();

        return $this->redirectToRoute('admin_entrada_edit', [
            'id' => $entrada->getId(),
        ]);
    }
}
