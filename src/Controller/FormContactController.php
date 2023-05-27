<?php

namespace App\Controller;

use App\Entity\FormContact;
use App\Form\FormContactType;
use App\Repository\FormContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;

/**
 * @Route("/form/contact")
 */
class FormContactController extends AbstractController
{
    /**
     * @Route("/", name="app_form_contact_index", methods={"GET"})
     */
    public function index(FormContactRepository $formContactRepository): Response
    {
        return $this->render('form_contact/index.html.twig', [
            'form_contacts' => $formContactRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_form_contact_new", methods={"GET", "POST"})
     */
    public function new(Request $request, FormContactRepository $formContactRepository): Response
    {
        $formContact = new FormContact();
        $form = $this->createForm(FormContactType::class, $formContact);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            if(!$this->isCsrfTokenValid('contact', $request->request->get('_token'))){
                return $this->redirectToRoute('index', [], Response::HTTP_BAD_REQUEST);
            }
            $formContactRepository->add($formContact, true);

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }
dd('da');
        return $this->renderForm('form_contact/new.html.twig', [
            'form_contact' => $formContact,
            'form' => $form,
        ]);
    }



    /**
     * @Route("/procesa_form", name="app_form_contact_procesa", methods={"GET", "POST"})
     */
    public function procesa(Request $request, FormContactRepository $formContactRepository): Response
    {
        $formContact = new FormContact();
        $form = $this->createForm(FormContactType::class, $formContact);

        $submittedToken = $request->request->get('token');
        $form->handleRequest($request);
        if(!$this->isCsrfTokenValid('form_contact', $submittedToken)){
            return $this->redirectToRoute('index');
        }

        if ($form->isSubmitted() ) {

            $formContactRepository->add($formContact, true);

            return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
        }
dd('da');
        return $this->renderForm('form_contact/new.html.twig', [
            'form_contact' => $formContact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_form_contact_show", methods={"GET"})
     */
    public function show(FormContact $formContact): Response
    {
        return $this->render('form_contact/show.html.twig', [
            'form_contact' => $formContact,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_form_contact_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, FormContact $formContact, FormContactRepository $formContactRepository): Response
    {
        $form = $this->createForm(FormContactType::class, $formContact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formContactRepository->add($formContact, true);

            return $this->redirectToRoute('app_form_contact_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('form_contact/edit.html.twig', [
            'form_contact' => $formContact,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_form_contact_delete", methods={"POST"})
     */
    public function delete(Request $request, FormContact $formContact, FormContactRepository $formContactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formContact->getId(), $request->request->get('_token'))) {
            $formContactRepository->remove($formContact, true);
        }

        return $this->redirectToRoute('app_form_contact_index', [], Response::HTTP_SEE_OTHER);
    }
}
