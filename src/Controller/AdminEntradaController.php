<?php

namespace App\Controller;

use App\Entity\Entrada;
use App\Entity\Principal;
use App\Entity\Section;
use App\Form\EntradaComplexType;
use App\Form\EntradaType;
use App\Form\Step\Entrada\StepOneType;
use App\Form\Step\Entrada\StepThreeType;
use App\Form\Step\Entrada\StepTwoType;
use App\Repository\EntradaRepository;
use App\Repository\ModelTemplateRepository;
use App\Repository\PrincipalRepository;
use App\Service\BoleanToDateHelper;
use App\Service\Handler\Image\ImageOptimizer;
use App\Service\LoggerClient;
use App\Service\ObtenerDatosHelper;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminEntradaController extends BaseController
{
    private LoggerClient $loggerClient;
    private BoleanToDateHelper $boleanToDateHelper;
    private ManagerRegistry $managerRegistry;
    private ImageOptimizer $imageOptimizer;

    /**
     * NO usado es opcional.
     * @param LoggerClient $loggerClient
     * @param BoleanToDateHelper $boleanToDateHelper
     * @param ManagerRegistry $managerRegistry
     * @param ImageOptimizer $imageOptimizer
     */
    public function __construct(
        LoggerClient $loggerClient,
        BoleanToDateHelper $boleanToDateHelper,
        ManagerRegistry $managerRegistry,
        ImageOptimizer $imageOptimizer

    ) {
        $this->loggerClient = $loggerClient;
        $this->boleanToDateHelper = $boleanToDateHelper;
        $this->managerRegistry = $managerRegistry;
        $this->imageOptimizer = $imageOptimizer;
    }

    /**
     * @Route("/admin/entrada", name="admin_entrada_index")
     * @IsGranted("ROLE_ESCRITOR")
     * @param EntradaRepository $entradaRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(
        EntradaRepository $entradaRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $bus = $request->get('busq');
        if ($this->isGranted('ROLE_EDITOR')) {
            $entrada = $entradaRepository->queryFindAllEntradas($bus);
        } else {
            $user = $this->getUser();
            $entrada = $entradaRepository->queryFindByAutor($user, $bus);
        }

        $entradas = $paginator->paginate(
            $entrada, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('admin/entrada/list.html.twig', [
            'entradas' => $entradas,
        ]);
    }

    /**
     * @Route("/admin/entrada/publicadas", name="admin_entrada_publicadas")
     * @IsGranted("ROLE_ESCRITOR")
     * @param EntradaRepository $entradaRepository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     * @throws QueryException
     */
    public function listadoPublicado(
        EntradaRepository $entradaRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {

        $this->isGranted('ROLE_EDITOR') ? $user = $this->getUser() : $user = null;
        $entrada = $entradaRepository->findAllPublicadosOrderedByPublicacionQuery($user);
        $entradas = $paginator->paginate(
            $entrada, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );

        return $this->render('admin/entrada/list.html.twig', [
            'entradas' => $entradas,
        ]);
    }

    /**
     * @param Request $request
     * @param Entrada $entrada
     * @param UploaderHelper $uploaderHelper
     * @param ObtenerDatosHelper $datosHelper
     * @return RedirectResponse
     * @throws Exception
     * @Route("/admin/entrada/{id}/edit", name="admin_entrada_edit")
     * @IsGranted("MANAGE", subject="entrada")
     */
    public function edit(
        Request $request,
        Entrada $entrada,
        UploaderHelper $uploaderHelper,
        ObtenerDatosHelper $datosHelper
    ): Response {
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
                $sizes = '500x500';
                if($entrada->getModelTemplate() && $entrada->getModelTemplate()->getSizes()){
                    $sizes = $entrada->getModelTemplate()->getSizes();
                }
                $this->imageOptimizer->resize($newFilename);
                $entrada->setImageFilename($newFilename);
            }

            $this->managerRegistry->getManager()->flush();

            $this->loggerClient->logMessage('Se editó la entrada \"'.$entrada->getTitulo().'\"', '');

            return $this->redirectToRoute('admin_entrada_index');
        }

        $ip = $datosHelper->getIpCliente();

        return $this->render('admin/entrada/edit.html.twig', [
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
     */
    public function editComplex(Request $request, Entrada $entrada): Response
    {
        $form = $this->createForm(EntradaComplexType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->managerRegistry->getManager()->flush();
            $this->loggerClient->logMessage('Se editó la entrada \"'.$entrada->getTitulo().'\"', '');

            return $this->redirectToRoute('admin_entrada_index');
        }

        return $this->render('admin/entrada/edit_contenido.html.twig', [
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
        if ($request->get('section')) {
            $entrada->addSection(
                $this->container->get('doctrine')->getRepository(Section::class)->find($request->get('section'))
            );
        }

        $form = $this->createForm(EntradaType::class, $entrada);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Entrada $entrada */
            $entrada = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['imageFile']->getData();

            $link = $form['linkRoute']->getData();

            $titulo = $form['titulo']->getData();

            if (!$link and $titulo) {
                $link = $this->limpiaLink($titulo);
            } else {
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

        return $this->render('admin/entrada/new.html.twig', [
            'entradaForm' => $form->createView(),
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/admin/new/step1", name="admin_entrada_new_step1", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws Exception
     * @IsGranted("ROLE_ESCRITOR")
     */
    public function newStepOne(Request $request, ModelTemplateRepository $modelTemplateRepository): Response
    {
        $entrada = new Entrada();
        $form = $this->createForm(StepOneType::class, $entrada);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $section = $form['section']->getData();
            $entrada->addSection($section);
            if ($session_template = $this->container->get('session')->get('model_template_id')) {
                if ($modelTemplate = $modelTemplateRepository->find($session_template)) {
                    $entrada->setModelTemplate($modelTemplate);
                }
            }
            $this->managerRegistry->getManager()->persist($entrada);
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('admin_entrada_new_step2', [
                'id' => $entrada->getId(),
            ]);
        }


        return $this->render('admin/entrada/new_step1.html.twig', [
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
    public function newStepTwo(Request $request, Entrada $entrada, PrincipalRepository $principalRepository): Response
    {
        $form = $this->createForm(StepTwoType::class, $entrada);
        $form->handleRequest($request);

        $linkRoutes = $principalRepository->getPrincipalSelect();

        if ($form->isSubmitted() && $form->isValid()) {

            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('admin_entrada_new_step3', [
                'id' => $entrada->getId(),
            ]);
        }

        return $this->render('admin/entrada/new_step2.html.twig', [
            'entrada' => $entrada,
            'entradaForm' => $form->createView(),
            'LinkRoutes' => $linkRoutes,
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
            $this->managerRegistry->getManager()->persist($entrada);
            $this->managerRegistry->getManager()->flush();

            return $this->redirectToRoute('admin_entrada_index', [
                'id' => $entrada->getId(),
            ]);
        }

        return $this->render('admin/entrada/new_step3.html.twig', [
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
        return $this->render('admin/entrada/link.html.twig', [
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
        return $this->render('admin/entrada/show.html.twig', [
            'entrada' => $entrada,
        ]);
    }

    /**
     * @Route("/admin/entrada/{id}/delete", name="entrada_delete", methods={"DELETE", "POST"})
     * @param Request $request
     * @param Entrada $entrada
     * @return Response
     */
    public function delete(Request $request, Entrada $entrada): Response
    {
        $status = 'error';
        $msg = 'No se puede borrar esta entrada. Comuníquese con el administrador';

        if ($this->isCsrfTokenValid('delete'.$entrada->getId(), $request->request->get('_token'))) {

            $msg = 'No cuenta con los permisos para borrar esta entrada. Comuníquese con el administrador';

            if ($this->getUser() === $entrada->getAutor() or $this->isGranted('ROLE_EDITOR')) {

                {
                    foreach ($entrada->getPrincipals() as $principal) {
                        $entrada->removePrincipal($principal);
                    }
                }

                foreach ($entrada->getSections() as $section) {
                    $entrada->removeSection($section);
                }

                foreach ($entrada->getComentarios() as $comentario) {
                    $entrada->removeComentario($comentario);
                }

                foreach ($entrada->getContacto() as $contacto) {
                    $entrada->removeContacto($contacto);
                }

                foreach ($entrada->getButton() as $button) {
                    $entrada->removeButton($button);
                }

                foreach ($entrada->getEntradaReferences() as $reference) {
                    $this->managerRegistry->getManager()->remove($reference);
                }

                $this->managerRegistry->getManager()->remove($entrada);
                $this->managerRegistry->getManager()->flush();
                $status = 'success';
                $msg = 'Se borro la entrada';
            }
        }

        $this->addFlash($status, $msg);

        return $this->redirectToRoute('admin_entrada_index');
    }

    /**
     * @param string $titulo
     * @return string
     */
    private function limpiaLink(string $titulo): string
    {
        $link = strtolower(str_replace(' ', '-', trim($titulo)));
        $link = strtolower(str_replace('<p>', '', trim($link)));

        return strtolower(str_replace('</p>', '', trim($link)));
    }

    /**
     * @param Principal|null $principal
     * @return string|null
     */
    private function getLinkRoute(?Principal $principal): ?string
    {
        if (null === $principal) {
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
        if (null === $linkRoute) {
            return null;
        }

        return $principalRepository->findBy(['linkRoute' => $linkRoute])[0];
    }
}
