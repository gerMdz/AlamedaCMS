<?php

namespace App\Security;

use App\Repository\ApiTokenRepository;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class ApiTokenAuthenticator extends AbstractGuardAuthenticator
{
    public function __construct(private readonly ApiTokenRepository $apiTokenRepository)
    {
    }

    public function supports(Request $request): bool
    {
        // Reviso las cabeceras "Authorization: Bearer <token>"
        return $request->headers->has('Authorization')
            && str_starts_with($request->headers->get('Authorization'), 'Bearer ');
    }

    public function getCredentials(Request $request): string
    {
        $authorizationHeader = $request->headers->get('Authorization');

        // Salto todo el "Bearer "
        return substr($authorizationHeader, 7);
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = $this->apiTokenRepository->findOneBy([
            'token' => $credentials,
        ]);
        if (!$token) {
            throw new CustomUserMessageAuthenticationException('API Token inválida');
        }
        if ($token->isExpired()) {
            throw new CustomUserMessageAuthenticationException('Token expirado');
        }

        return $token->getUser();
    }

    public function checkCredentials($credentials, UserInterface $user): true
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): JsonResponse
    {
        return new JsonResponse([
            'message' => $exception->getMessageKey(),
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // todo
    }

    public function start(Request $request, ?AuthenticationException $authException = null): Response
    {
        throw new Exception('No utilizado: se utiliza el punto de entrada de otro autenticador');
    }

    public function supportsRememberMe(): false
    {
        return false;
    }
}
