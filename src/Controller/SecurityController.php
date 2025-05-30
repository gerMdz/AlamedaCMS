<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\Model\UserRegistrationFormModel;
use App\Form\Model\VoluntarioReservaRegistrationFormModel;
use App\Form\UserRegistrationFormType;
use App\Form\VoluntarioReservaRegistrationFormType;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use App\Service\ErrorHandler;
use Doctrine\ORM\EntityManagerInterface;
use LogicException;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

/**
 * Controlador para gestionar la seguridad y autenticación de usuarios.
 * 
 * Este controlador maneja las operaciones relacionadas con la autenticación de usuarios,
 * incluyendo inicio de sesión, cierre de sesión, registro de usuarios y registro de voluntarios.
 */
class SecurityController extends AbstractController
{

    /**
     * Constructor del controlador de seguridad.
     * 
     * @param CsrfTokenManagerInterface $csrfTokenManager Gestor de tokens CSRF para protección contra ataques CSRF
     * @param ErrorHandler $errorHandler Servicio centralizado para manejo de errores
     */
    public function __construct(
        readonly CsrfTokenManagerInterface $csrfTokenManager,
        readonly ErrorHandler $errorHandler)
    {
    }

    /**
     * Maneja el proceso de inicio de sesión de usuarios.
     * 
     * Este método renderiza el formulario de inicio de sesión y procesa los errores
     * de autenticación si los hubiera.
     * 
     * @param AuthenticationUtils $authenticationUtils Utilidad para obtener información de autenticación
     * @param Request $request Objeto de solicitud HTTP
     * 
     * @return Response Respuesta HTTP con la página de inicio de sesión
     */
    #[Route(path: '/admin/ingreso', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        try {
            $this->container->get('doctrine');
        } catch (NotFoundExceptionInterface|ContainerExceptionInterface $e) {
            // Manejar error de servicio
            $this->errorHandler->manejarErrorServicio('No se pudo conectar con la base de datos', [
                'exception' => get_class($e),
                'message' => $e->getMessage(),
            ]);
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        // Si hay un error de autenticación, registrarlo con el manejador de errores
        if ($error) {
            $this->errorHandler->manejarErrorAutenticacion(
                'Credenciales inválidas o cuenta bloqueada',
                [
                    'username' => $lastUsername,
                    'error' => $error->getMessage(),
                ],
                true // mostrar mensaje flash
            );
        }

        return $this->render('admin/security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * Maneja el proceso de cierre de sesión de usuarios.
     * 
     * Este método no se ejecuta realmente, ya que el cierre de sesión es manejado
     * por el firewall de seguridad de Symfony. Está aquí solo para definir la ruta.
     * 
     * @throws LogicException Siempre lanza esta excepción si se llega a ejecutar
     */
    #[Route(path: '/admin/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /**
     * Maneja el proceso de registro de nuevos usuarios.
     * 
     * Este método procesa el formulario de registro, crea un nuevo usuario
     * con los datos proporcionados, lo persiste en la base de datos y
     * autentica al usuario recién registrado.
     * 
     * @param Request $request Objeto de solicitud HTTP
     * @param UserPasswordHasherInterface $userPasswordHasher Servicio para cifrar contraseñas
     * @param UserAuthenticatorInterface $userAuthenticator Servicio para autenticar usuarios
     * @param LoginFormAuthenticator $formAuthenticator Autenticador específico para el formulario de inicio de sesión
     * @param EntityManagerInterface $entityManager Gestor de entidades para persistir datos
     * 
     * @return Response Respuesta HTTP, redirige al usuario autenticado o muestra el formulario
     */
    #[Route(path: '/admin/registro', name: 'app_registro')]
    public function register(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        LoginFormAuthenticator $formAuthenticator,
        EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UserRegistrationFormModel $userModel */
            $userModel = $form->getData();
            $user = new User();
            $user->setEmail($userModel->email);
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, $userModel->plainPassword)
            );
            $user->setRoles(['ROLE_USER']);
            if ($form['roles']->getData()) {
                $user->setRoles([$form['roles']->getData()]);
            }
            $user->setRoles(['ROLE_USER']);
            $user->setPrimerNombre($userModel->primerNombre);
            if (true === $userModel->aceptaTerminos) {
                $user->aceptaTerminos();
            }

            $entityManager->persist($user);
            $entityManager->flush();

            return $userAuthenticator->authenticateUser(
                $user,
                $formAuthenticator,
                $request
            );
        }

        return $this->render('security/register.html.twig', [
            'registroForm' => $form,
        ]);
    }

    /**
     * Maneja el proceso de registro de voluntarios para reservas.
     * 
     * Este método procesa el formulario de registro de voluntarios, crea un nuevo usuario
     * con el rol de reserva, verifica si ya existe un usuario con el mismo email,
     * y persiste el nuevo usuario en la base de datos.
     * 
     * @param Request $request Objeto de solicitud HTTP
     * @param UserPasswordHasherInterface $userPasswordHasher Servicio para cifrar contraseñas
     * @param UserRepository $userRepository Repositorio para consultar usuarios existentes
     * @param EntityManagerInterface $entityManager Gestor de entidades para persistir datos
     * 
     * @return Response Respuesta HTTP, redirige a la misma página con mensaje de éxito o muestra el formulario
     */
    #[Route(path: '/admin/registro_voluntario_reserva', name: 'app_registro_voluntario_reserva')]
    public function registerVoluntarioReserva(Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoluntarioReservaRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var VoluntarioReservaRegistrationFormModel $userModel */
            $userModel = $form->getData();
            $user = new User();
            $email = strtolower((string) $userModel->primerNombre).'@alameda.ar';
            $isUser = $userRepository->findBy(['email' => $email]);
            if ($isUser) {
                // Usar el manejador de errores para registrar que el usuario ya existe
                $this->errorHandler->manejarErrorValidacion(
                    sprintf('El usuario %s ya existe', $email),
                    ['email' => $email],
                    true // mostrar mensaje flash
                );

                return $this->redirectToRoute('app_registro_voluntario_reserva');
            }
            $user->setEmail($email);
            $user->setPassword(
                $userPasswordHasher->hashPassword($user, 'Alameda2020!')
            );
            $user->setRoles(['ROLE_USER']);

            $user->setRoles(['ROLE_RESERVA']);
            $user->setPrimerNombre($userModel->primerNombre);

            $user->aceptaTerminos();

            try {
                $entityManager->persist($user);
                $entityManager->flush();

                // Usar el manejador de errores para registrar el éxito (usando logInfo)
                $this->errorHandler->logInfo(
                    'Se agregó correctamente al usuario '.$user->getEmail(),
                    ['email' => $user->getEmail()]
                );

                // Añadir mensaje flash de éxito
                $this->addFlash('success', 'Se agregó correctamente al usuario '.$user->getEmail());

                return $this->redirectToRoute('app_registro_voluntario_reserva');
            } catch (\Exception $e) {
                // Manejar error de base de datos
                $this->errorHandler->manejarErrorDatabase(
                    'Error al guardar el usuario en la base de datos',
                    [
                        'exception' => get_class($e),
                        'message' => $e->getMessage(),
                        'email' => $email
                    ]
                );

                return $this->redirectToRoute('app_registro_voluntario_reserva');
            }
        }

        return $this->render('security/registerVoluntarioReserva.html.twig', [
            'registroForm' => $form,
        ]);
    }

    /**
     * Ruta de prueba para verificar el funcionamiento de las sesiones.
     * 
     * Este método establece una variable de sesión, luego la recupera
     * y la devuelve como respuesta para verificar que las sesiones
     * están funcionando correctamente.
     * 
     * @param Request $request Objeto de solicitud HTTP
     * 
     * @return Response Respuesta HTTP con el valor de la variable de sesión
     */
    #[Route(path: '/test/route/index', name: 'app_test_route')]
    public function testRoute(Request $request)
    {
        // Establecer una variable de sesión
        $request->getSession()->set('test', 'Hello, session!');

        // Obtener la variable de sesión
        $sessionValue = $request->getSession()->get('test');

        return new Response($sessionValue); // Deberías ver 'Hello, session!' en esta ruta
    }
}
