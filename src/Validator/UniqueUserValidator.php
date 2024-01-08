<?php

namespace App\Validator;

use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueUserValidator extends ConstraintValidator
{
    /**
     * UniqueUserValidator constructor.
     */
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function validate($value, Constraint $constraint)
    {
        /* @var $constraint UniqueUser */

        if (null === $value || '' === $value) {
            return;
        }
        $exiteUser = $this->userRepository->findOneBy(['email' => $value]);

        if (!$exiteUser) {
            return;
        }

        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
