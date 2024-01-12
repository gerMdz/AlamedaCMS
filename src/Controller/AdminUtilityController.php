<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminUtilityController extends AbstractController
{
    #[Route(path: '/admin/utility/user', methods: ['GET'], name: 'admin_utility_user')]
    #[\Symfony\Component\Security\Http\Attribute\IsGranted('ROLE_ESCRITOR')]
    public function getUserEscritorApi(UserRepository $userRepository, Request $request): JsonResponse
    {
        $role = empty($request->query->get('role')) ? 'ROLE_NADA' : $request->query->get('role');
        $query = $request->query->get('query');

        $user = $userRepository->findAllEmailsRoleAlfa($query, $role);

        return $this->json(['users' => $user], 200, [], [
            'groups' => ['perfil'],
        ]);
    }

    #[Route(path: '/admin/list/user', methods: ['GET'], name: 'admin_list_user')]
    public function usersList(UserRepository $userRepository): Response
    {
        return $this->render('admin/users.html.twig', [
            'users' => $userRepository->findBy([], ['primerNombre' => 'ASC']),
        ]);
    }
}
