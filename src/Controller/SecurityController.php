<?php

namespace App\Controller;

use App\Entity\IndexAlameda;
use App\Entity\User;
use App\Form\Model\UserRegistrationFormModel;
use App\Form\UserRegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
//    /**
//     * @Route("/login", name="app_login")
//     */
//    public function index()
//    {
//        $em = $this->getDoctrine()->getManager();
//        $indexAlameda = $em->getRepository(IndexAlameda::class)->findAll();
//        return $this->render('security/index.html.twig', [
//            'datosIndex'=> $indexAlameda[0]
//
//        ]);
//    }

    /**
     * @Route("/admin/ingreso", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $em = $this->getDoctrine()->getManager();
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            ]);
    }

    /**
     * @Route("/admin/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * @Route("/admin/registro", name="app_registro")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $authenticatorHandler
     * @param LoginFormAuthenticator $formAuthenticator
     * @return Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $authenticatorHandler, LoginFormAuthenticator $formAuthenticator)
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /** @var UserRegistrationFormModel $userModel */
            $userModel = $form->getData();
            $user = new User();
            $user->setEmail($userModel->email);
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $userModel->plainPassword)
            );
            $user->setRoles(['ROLE_USER']);
            $user->setPrimerNombre($userModel->primerNombre);
            if(true === $userModel->aceptaTerminos){
                $user->aceptaTerminos();
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $authenticatorHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $formAuthenticator,
                'main'
            );

        }


//        if ($request->isMethod('POST')) {
//            $user = new User();
//            $user->setEmail($request->request->get('email'));
//            $user->setPrimerNombre($request->request->get('primernombre'));
//            $user->setPassword($passwordEncoder->encodePassword(
//                $user,
//                $request->request->get('password')
//            ));
//            $user->setRoles(['ROLE_USER']);
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($user);
//            $em->flush();
//
//            return $authenticatorHandler->authenticateUserAndHandleSuccess(
//                $user,
//                $request,
//                $formAuthenticator,
//                'main'
//            );
//        }

        return $this->render('security/register.html.twig',[
            'regristroForm'=>$form->createView()
        ]);
    }
}
