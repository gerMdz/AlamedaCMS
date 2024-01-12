<?php

namespace App\Form\DataTransformer;

use App\Entity\User;
use App\Repository\UserRepository;
use LogicException;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class EmailToUserTransformer implements DataTransformerInterface
{
    private $finderCallback;

    /**
     * EmailToUserTransformer constructor.
     */
    public function __construct(protected UserRepository $userRepository, callable $finderCallback)
    {
        $this->finderCallback = $finderCallback;
    }

    /**
     * @param $value
     * @return mixed|string|null
     */
    public function transform($value): mixed
    {
        if (null === $value) {
            return '';
        }

        if (!$value instanceof User) {
            throw new LogicException('El UserSelectTextType solo puede usarse con un User objeto');
        }

        return $value->getEmail();
    }

    /**
     * @param $value
     * @return mixed|string
     */
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
