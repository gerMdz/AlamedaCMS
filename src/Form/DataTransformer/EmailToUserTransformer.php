<?php

namespace App\Form\DataTransformer;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EmailToUserTransformer implements DataTransformerInterface
{
    protected $userRepository;
    private $finderCallback;

    /**
     * EmailToUserTransformer constructor.
     */
    public function __construct(UserRepository $userRepository, callable $finderCallback)
    {
        $this->userRepository = $userRepository;
        $this->finderCallback = $finderCallback;
    }

    public function transform($value)
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof User) {
            throw new \LogicException('El UserSelectTextType solo puede usarse con un User objecto');
        }

        return $value->getEmail();
    }

    public function reverseTransform($value)
    {
        if (null === $value) {
            return '';
        }

        $callback = $this->finderCallback;
        $user = $callback($this->userRepository, $value);
        if (!$user) {
            throw new TransformationFailedException(sprintf('No se encontró ningún usuario con el correo electrónico "%s"', $value));
        }

        return $user;
    }
}
