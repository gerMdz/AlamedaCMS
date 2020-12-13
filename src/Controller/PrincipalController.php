<?php

namespace App\Controller;

use App\Entity\Principal;
use App\Form\PrincipalType;
use App\Repository\PrincipalRepository;
use App\Service\UploaderHelper;
use DateTime;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/principal")
 */
class PrincipalController extends BaseController
{
    /**
     * @Route("/", name="principal_index", methods={"GET"})
     * @param PrincipalRepository $principalRepository
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(PrincipalRepository $principalRepository): Response
    {
        return $this->render('principal/index.html.twig', [
            'principals' => $principalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="principal_new", methods={"GET","POST"})
     * @param Request $request
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     * @throws Exception
     */
    public function new(Request $request, UploaderHelper $uploaderHelper): Response
    {

        $principal = new Principal();
        $user = $this->getUser();
        $ahora = new DateTime('now');
        $principal->setAutor($user);
        $principal->setCreatedAt($ahora);
        $principal->setUpdatedAt($ahora);
        $form = $this->createForm(PrincipalType::class, $principal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Principal $principal */
            $principal = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $principal->setImageFilename($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($principal);
            $entityManager->flush();

            return $this->redirectToRoute('admin');
        }

        return $this->render('principal/new.html.twig', [
            'principal' => $principal,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="principal_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Principal $principal
     * @param UploaderHelper $uploaderHelper
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Principal $principal, UploaderHelper $uploaderHelper): Response
    {
        $form = $this->createForm(PrincipalType::class, $principal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, $principal->getImageFilename());
                $principal->setImageFilename($newFilename);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('principal_index');
        }

        return $this->render('principal/edit.html.twig', [
            'principal' => $principal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principal_delete", methods={"DELETE"})
     * @param Request $request
     * @param Principal $principal
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Principal $principal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$principal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_index');
    }
}
