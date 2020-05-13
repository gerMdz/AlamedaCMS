<?php

namespace App\Security\Voter;

use App\Entity\Entrada;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class EntradaVoter extends Voter
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['ROLE_ADMIN_ENTRADAS'])
            && $subject instanceof Entrada;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        /**
         * @var Entrada $subject
         */
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'ROLE_ADMIN_ENTRADAS':
                // logic to determine if the user can EDIT
                // return true or false
                if ($subject->getAutor() == $user) {
                    return true;
                }
                if ($this->security->isGranted('ROLE_ADMIN_ENTRADAS')) {
                    return true;
                }
                 return false;


        }

        return false;
    }
}
