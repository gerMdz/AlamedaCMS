<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Entity\Principal;
use App\Form\EntradaComplexType;
use App\Form\EntradaType;
use App\Form\Step\Entrada\StepOneType;
use App\Form\Step\Entrada\StepThreeType;
use App\Form\Step\Entrada\StepTwoType;
use App\Repository\EntradaRepository;
use App\Repository\PrincipalRepository;
use App\Service\BoleanToDateHelper;
use App\Service\LoggerClient;
use App\Service\ObtenerDatosHelper;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEntradaController extends AbstractController
{
    private LoggerClient $loggerClient;
    private BoleanToDateHelper $boleanToDateHelper;

    /**
     * NO usado es opcional.
     * @param LoggerClient $loggerClient
     * @param BoleanToDateHelper $boleanToDateHelper
     */
    public function __construct(LoggerClient $loggerClient, BoleanToDateHelper $boleanToDateHelper)
    {
        $this->loggerClient = $loggerClient;
        $this->boleanToDateHelper = $boleanToDateHelper;
    }

    /**
     * @Route("/admin/entrada", name="admin_entrada_index")
     * @IsGranted("ROLE_ESCRITOR")
     * @param EntradaRepository $entradaRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(EntradaRepository $entradaRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $bus = $request->get('busq');
        if ($this->isGranted('ROLE_EDITOR')) {
            $entrada = $entradaRepository->queryFindAllEntradas($bus);
        } else {
            $user = $this->getUser();
            $entrada = $entradaRepository->queryFindByAutor($user);
        }

        $entradas = $paginator->paginate(
            $entrada, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('admin_entrada/list.html.twig', [
            'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/admin/entrada/publicadas", name="admin_entrada_publicadas")
     * @IsGranted("ROLE_ESCRITOR")
     * @param EntradaRepository $entradaRepository
     * @return Response
     * @throws QueryException
     */
    public function listadoPublicado(EntradaRepository $entradaRepository): Response
    {
        $this->isGranted('ROLE_EDITOR') ? $entrada = $entradaRepository->findAllPublicadosOrderedByPublicacion() : $entrada = $entradaRepository->findAllPublicadosOrderedByPublicacion($this->getUser());

        return $this->render('admin_entrada/list.html.twig', [
            'entradas' => $entrada,
        ]);
    }

    /**
     * @param Request $request
     * @param Entrada $entrada
     * @param UploaderHelper $uploaderHelper
     * @param ObtenerDatosHelper $datosHelper
     * @param PrincipalRepository $principalRepository
     * @return RedirectResponse
     * @throws Exception
     * @Route("/admin/entrada/{id}/edit", name="admin_entrada_edit")
     * @IsGranted("MANAGE", subject="entrada")
     */
    public function edit(
        Request $request,
        Entrada $entrada,
        UploaderHelper $uploaderHelper,
        ObtenerDatosHelper $datosHelper,
        PrincipalRepository $principalRepository
    ): Response
    {
        $form = $this->createForm(EntradaType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();
            $boolean = $form['publicar']->getData();
            $link = $form['linkRoute']->getData();


            $publicado = $this->boleanToDateHelper->setDatatimeForTrue($boolean);
            $entrada->setPublicadoAt($publicado);

            $entrada->setLinkRoute($link);

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, $entrada->getImageFilename());
                $entrada->setImageFilename($newFilename);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->loggerClient->logMessage('Se editó la entrada \"' . $entrada->getTitulo() . '\"', '');

            return $this->redirectToRoute('admin_entrada_index');
        }

        $ip = $datosHelper->getIpCliente();

        return $this->render('entrada/edit.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
            'ip' => $ip,
        ]);
    }

    /**
     * @param Request $request
     * @param Entrada $entrada
     * @return RedirectResponse
     * @throws Exception
     * @Route("/admin/entrada/{id}/edit-complex", name="admin_entrada_edit_complex")
     * @IsGranted("MANAGE", subject="entrada")
     *
     */
    public function editComplex(Request $request, Entrada $entrada): Response
    {
        $form = $this->createForm(EntradaComplexType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->loggerClient->logMessage('Se editó la entrada \"' . $entrada->getTitulo() . '\"', '');

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin_entrada/edit_contenido.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/entrada/new", name="admin_entrada_new")
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

            $link = $form['linkRoute']->getData();

            $titulo = $form['titulo']->getData();

            if(!$link and $titulo) {
                $link = $this->limpiaLink(null,$titulo);
            }else{
                $link = $link->getlinkRoute();
            }


            $entrada->setLinkRoute($link);

            if ($uploadedFile) {
                $newFilename = $uploaderHelper->uploadEntradaImage($uploadedFile, false);
                $entrada->setImageFilename($newFilename);
            }

            $boolean = $form['publicar']->getData();


            $publicado = $this->boleanToDateHelper->setDatatimeForTrue($boolean);
            $entrada->setPublicadoAt($publicado);

            $em->persist($entrada);
            $em->flush();

            $this->addFlash('success', 'Se agregó una entrada al sitio');

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin_entrada/new.html.twig', [
            'entradaForm' => $form->createView(),
            'entrada' => $entrada,
        ]);
    }
    /**
     * @Route("/admin/new/step1", name="admin_entrada_new_step1", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_ADMIN")
     */
    public function newStepOne(Request $request): Response
    {
        $entrada = new Entrada();
        $form = $this->createForm(StepOneType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $section = $form['section']->getData();
            $entrada->addSection($section);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('admin_entrada_new_step2', [
                'id' => $entrada->getId()
            ]);
        }

        return $this->render('admin_entrada/new_step1.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/new/step2/{id}", name="admin_entrada_new_step2", methods={"GET","POST"})
     * @param Request $request
     * @param Entrada $entrada
     * @return Response
     * @IsGranted("ROLE_ADMIN")
     */
    public function newStepTwo(Request $request, Entrada $entrada): Response
    {

        $form = $this->createForm(StepTwoType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_entrada_new_step3', [
                'id' => $entrada->getId()
            ]);
        }

        return $this->render('admin_entrada/new_step2.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/new/step3", name="admin_entrada_new_step3", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_ESCRITOR")
     */
    public function newStepThree(Request $request): Response
    {
        $entrada = new Entrada();
        $form = $this->createForm(StepThreeType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $section = $form['section']->getData();
            $entrada->addSection($section);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($entrada);
            $entityManager->flush();

            return $this->redirectToRoute('admin_entrada_index', [
                'id' => $entrada->getId()
            ]);
        }

        return $this->render('admin_entrada/new_step3.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/admin/entrada/{linkRoute}", name="entrada_admin_link")
     *
     * @param Entrada $entrada
     * @return Response
     */
    public function link(Entrada $entrada): Response
    {
        return $this->render('entrada/link.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/admin/entrada/{id}/show", name="entrada_show", methods={"GET"})
     * @param Entrada $entrada
     * @return Response
     */
    public function show(Entrada $entrada): Response
    {
        if (!$entrada) {
            throw $this->createNotFoundException(sprintf('No se encontró la entrada "%s"', $entrada));
        }

        return $this->render('entrada/show.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/admin/entrada/{id}", name="entrada_delete", methods={"DELETE"})
     * @param Request $request
     * @param Entrada $entrada
     * @return Response
     */
    public function delete(Request $request, Entrada $entrada): Response
    {
        if ($this->isCsrfTokenValid('delete' . $entrada->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($entrada);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_entrada_index');
    }

    /**
     * @param null|string $link
     * @param string $titulo
     * @return string
     */
    private function limpiaLink(?string $link , string $titulo): string
    {
        if ('' != $link) {
            $link = strtolower(str_replace(' ', '-', trim($link)));
        } else {
            $link = strtolower(str_replace(' ', '-', trim($titulo)));
            $link = strtolower(str_replace('<p>', '', trim($link)));
            $link = strtolower(str_replace('</p>', '', trim($link)));
        }
        return $link;
    }


    /**
     * @param Principal|null $principal
     * @return string|null
     */
    private function getLinkRoute(?Principal $principal): ?string
    {
        if(null === $principal){
            return null;
        }
        return $principal->getLinkRoute();
    }

    /**
     * @param string|null $linkRoute
     * @param PrincipalRepository $principalRepository
     * @return Principal|null
     */
    private function getPrincipal(?string $linkRoute, PrincipalRepository $principalRepository): ?Principal
    {
        if(null === $linkRoute){
            return null;
        }

        return $principalRepository->findBy(['linkRoute' => $linkRoute])[0];
    }
}
