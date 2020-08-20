<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\UserType;
use App\Repository\IndexAlamedaRepository;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @IsGranted("ROLE_USER")
 *
 * @method User|null getUser()
 */
class PerfilController extends BaseController
{
    /**
     * @Route("web/perfil", name="app_perfil")
     *
     * @param IndexAlamedaRepository $indexAlamedaRepository
     * @return Response
     */
    public function index(IndexAlamedaRepository $indexAlamedaRepository)
    {


        return $this->render('perfil/perfil_index.html.twig', [
            'datosIndex' => $indexAlamedaRepository->findAll()[0],
        ]);
    }

    /**
     * @Route("/api/perfil", name="api_perfil")
     */
    public function apiPerfil()
    {
        $user = $this->getUser();

        return $this->json($user, 200, [], [
            'groups' => ['perfil'],
        ]);
    }

    /**
     * @Route("/web/cambiopassword/{email}", name="app_changepassword")
     * @param Request $request
     * @param User $user
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param AuthenticationUtils $authenticationUtils
     * @param UserRepository $userRepository
     * @return Response
     */
    public function changePassword(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder, AuthenticationUtils $authenticationUtils, UserRepository $userRepository){

        $form = $this->createForm(ChangePasswordType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var User $user */
            $password = $form['password']->getData();
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $password)
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $error = $authenticationUtils->getLastAuthenticationError();
            $lastUsername = $authenticationUtils->getLastUsername();

            return $this->render('security/login.html.twig', [
                'last_username' => $lastUsername,
                'error' => $error,
            ]);
        }

        return $this->render('security/changepassword.html.twig',[
            'user' => $user,
            'form'=>$form->createView()
        ]);

    }
}
