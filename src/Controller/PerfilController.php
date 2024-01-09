<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Repository\IndexAlamedaRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @method User|null getUser()
 */
#[IsGranted('ROLE_USER')]
class PerfilController extends BaseController
{
    #[Route(path: 'web/perfil', name: 'app_perfil')]
    public function index(IndexAlamedaRepository $indexAlamedaRepository): Response
    {
        return $this->render('perfil/perfil_index.html.twig', [
            'datosIndex' => $indexAlamedaRepository->findAll()[0],
        ]);
    }

    #[Route(path: '/api/perfil', name: 'api_perfil')]
    public function apiPerfil(): JsonResponse
    {
        $user = $this->getUser();

        return $this->json($user, 200, [], [
            'groups' => ['perfil'],
        ]);
    }

    #[Route(path: '/web/cambiopassword/{email}', name: 'app_changepassword')]
    public function changePassword(
        Request $request, User $user,
        UserPasswordHasherInterface $userPasswordHasher,
        AuthenticationUtils $authenticationUtils): Response
    {
        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $password = $form['password']->getData();
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, $password)
            );
            try {
                $em = $this->container->get('doctrine')->getManager();
                $em->persist($user);
                $em->flush();
            } catch (NotFoundExceptionInterface|ContainerExceptionInterface) {
            }

            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('security/login.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ]);
        }

        return $this->render('security/change-password.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
