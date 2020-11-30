<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminUtilityController extends AbstractController
{

    /**
     * @Route("/admin/utility/user", methods={"GET"}, name="admin_utility_user")
     * @param UserRepository $userRepository
     * @param Request $request
     * @return JsonResponse
     * @IsGranted("ROLE_ESCRITOR")
     */
    public function getUserEscritorApi(UserRepository $userRepository, Request $request)
    {
        $role = empty($request->query->get('role'))?'ROLE_NADA' : $request->query->get('role') ;
        $query = $request->query->get('query');

        $user = $userRepository->findAllEmailsRoleAlfa($role, $query);


        return $this->json(['users'=>$user], 200, [], [
            'groups' => ['perfil'],
        ]);
    }

}