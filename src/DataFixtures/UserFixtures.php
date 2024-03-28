<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends BaseFixture implements FixtureGroupInterface
{
    /**
     * UserFixtures constructor.
     */
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function ($i) use ($manager) {
            $user = new User();
            $user->setEmail(sprintf('alameda%d@alameda.com', $i));
            $user->setPrimerNombre($this->faker->firstName);
            $user->setPassword($this->userPasswordHasher->hashPassword(
                $user,
                'Ninguna'
            ));
            $user->setRoles(['ROLE_USER']);
            if ($this->faker->boolean) {
                $user->setTwitterUsername($this->faker->userName);
            }
            $user->aceptaTerminos();

            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);

            return $user;
        });

        $this->createMany(3, 'admin_users', function ($i) {
            $user = new User();
            $user->setEmail(sprintf('admin%d@alameda.com', $i));
            $user->setPrimerNombre($this->faker->firstName);
            if ($this->faker->boolean) {
                $user->setTwitterUsername($this->faker->userName);
            }
            $user->setRoles(['ROLE_ADMIN']);
            $user->aceptaTerminos();
            $user->setPassword($this->userPasswordHasher->hashPassword(
                $user,
                'Ninguna'
            ));

            return $user;
        });

        $this->createMany(5, 'escitor_users', function ($i) {
            $user = new User();
            $user->setEmail(sprintf('escritor%d@alameda.com', $i));
            $user->setPrimerNombre($this->faker->firstName);
            if ($this->faker->boolean) {
                $user->setTwitterUsername($this->faker->userName);
            }
            $user->setRoles(['ROLE_ESCRITOR']);
            $user->setPassword($this->userPasswordHasher->hashPassword(
                $user,
                'Ninguna'
            ));
            $user->aceptaTerminos();

            return $user;
        });

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['groupuser'];
    }
}
