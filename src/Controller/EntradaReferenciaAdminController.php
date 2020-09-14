<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Entity\EntradaReference;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
     * @param ValidatorInterface $validator
     */
    public function uploadEntradaReference(Entrada $entrada, Request $request, UploaderHelper $helper, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        /** @var UploadedFile $uploadedFile */
        $uploadedFile = $request->files->get('reference');

        $nopermitidos = $validator->validate(
            $uploadedFile, [
                new NotBlank([
                        'message' => 'Por favor seleccione una archivo 📁'
                    ]
                ),
                new File([
                    'maxSize' => '5M',
                    'mimeTypes' => [
                        'image/*',
                        'application/pdf',
                        'application/msword',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                        'text/plain'
                    ]
                ])
            ]
        );

        if ($nopermitidos->count() > 0) {
            return $this->json($nopermitidos, 400);
//            $nopermitido = $nopermitidos[0];
//            $this->addFlash('error', $nopermitido->getMessage());
//            return $this->redirectToRoute('admin_entrada_edit', [
//                'id' => $entrada->getId(),
//            ]);
        }

        $filename = $helper->uploadEntradaReference($uploadedFile);


        $entradaReference = new EntradaReference($entrada);
        $entradaReference->setFilename($filename);
        $entradaReference->setoriginalFilename($uploadedFile->getClientOriginalName() ?? $filename);
        $entradaReference->setMimeType($uploadedFile->getMimeType() ?? 'application/octet-stream');
        $em->persist($entradaReference);
        $em->flush();

        return $this->json(
            $entradaReference,
            201,
            [],
            [
                'groups'=>['main']
            ]


        );

//        return $this->redirectToRoute('admin_entrada_edit', [
//            'id' => $entrada->getId(),
//        ]);
    }

    /**
     * @Route("/admin/entrada/{id}/referencia", methods="GET", name="admin_entrada_list_referencia")
     * @param Entrada $entrada
     * @return JsonResponse
     */
    public function getEntradaReferences(Entrada $entrada)
    {
        return $this->json(
            $entrada->getEntradaReferences(),
            200,
            [],
            [
                'groups' => ['main']
            ]
        );
    }

    /**
     * @Route("/admin/entrada/referencias/{id}/download", name="admin_entrada_download_reference", methods={"GET"})
     * @param EntradaReference $reference
     * @param UploaderHelper $uploaderHelper
     * @return StreamedResponse
     */
    public function downloadEntradaReference(EntradaReference $reference, UploaderHelper $uploaderHelper)
    {
        $response = new StreamedResponse(function () use ($reference, $uploaderHelper) {
            $outputStream = fopen('php://output', 'wb');
            $fileStream = $uploaderHelper->readStream($reference->getImagePath(), false);
            stream_copy_to_stream($fileStream, $outputStream);
        });
        $response->headers->set('Content-Type', $reference->getMimeType());
        $disposition = HeaderUtils::makeDisposition(
            HeaderUtils::DISPOSITION_ATTACHMENT,
//Si queremos previzualizar el documento comentar la fila anterior y descomentar la siguiente
//            HeaderUtils::DISPOSITION_INLINE,
            $reference->getoriginalFilename()
        );
        $response->headers->set('Content-Disposition', $disposition);

//        dd($reference);
        return $response;
    }

    /**
     * @Route("/admin/entrada/references/{id}", name="admin_entrada_delete_reference", methods={"DELETE"})
     * @param EntradaReference $reference
     * @param UploaderHelper $uploaderHelper
     * @param EntityManagerInterface $entityManager
     * @return Response
     * @throws Exception
     */
    public function deleteEntradaReference(EntradaReference $reference, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager)
    {
        $entrada = $reference->getEntrada();
        $this->denyAccessUnlessGranted('MANAGE', $entrada);

        $entityManager->remove($reference);
        $entityManager->flush();

        $uploaderHelper->deleteFile($reference->getImagePath(), false);

        return new Response(null, 204);
    }

    /**
     * @Route("/admin/entrada/references/{id}", name="admin_entrada_update_reference", methods={"PUT"})
     * @param EntradaReference $reference
     * @param UploaderHelper $uploaderHelper
     * @param EntityManagerInterface $entityManager
     * @param SerializerInterface $serializer
     * @param Request $request
     * @param ValidatorInterface $validator
     * @return JsonResponse
     */
    public function updateEntradaReference(EntradaReference $reference, UploaderHelper $uploaderHelper, EntityManagerInterface $entityManager, SerializerInterface $serializer, Request $request, ValidatorInterface $validator)
    {
        $entrada = $reference->getEntrada();
        $this->denyAccessUnlessGranted('MANAGE', $entrada);

        $serializer->deserialize(
            $request->getContent(),
            EntradaReference::class,
            'json',
            [
                'object_to_populate' => $reference,
                'groups' => ['input']
                ]
        );
        $notAssert = $validator->validate($reference);
        if ($notAssert->count() > 0) {
            return $this->json($notAssert, 400);
        }
         $entityManager->persist($reference);
         $entityManager->flush();

        return $this->json(
            $reference,
            200,
            [],
            [
                'groups' => ['main']
            ]
        );

    }

    /**
     * @Route("/admin/entrada/{id}/referencia/reorder", methods="POST", name="admin_entrada_reorder_referencia")
     * @IsGranted("MANAGE", subject="entrada")
     * @param Entrada $entrada
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     * @return JsonResponse
     */
    public function reorderEntradaReferences(Entrada $entrada, EntityManagerInterface $entityManager, Request $request)
    {
        $orderedIds = json_decode($request->getContent(), true);

        if ($orderedIds === null) {
            return $this->json(['detail' => 'Datos Inválidos'], 400);
        }

        // from (position)=>(id) to (id)=>(position)
        $orderedIds = array_flip($orderedIds);

        foreach ($entrada->getEntradaReferences() as $reference) {
            $reference->setPosicion($orderedIds[$reference->getId()]);
        }

        $entityManager->flush();

        return $this->json(
            $entrada->getEntradaReferences(),
            200,
            [],
            [
                'groups' => ['main']
            ]
        );
    }
}
