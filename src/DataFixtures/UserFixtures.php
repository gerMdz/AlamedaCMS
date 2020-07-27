<?php

namespace App\DataFixtures;

use App\Entity\ApiToken;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
//    public function load(ObjectManager $manager)
//    {
//        // $product = new Product();
//        // $manager->persist($product);
//
//        $manager->flush();
//    }

    private $userPasswordEncoder;

    /**
     * UserFixtures constructor.
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function ($i) use ($manager) {
            $user = new User();
            $user->setEmail(sprintf('alameda%d@alameda.com', $i));
            $user->setPrimerNombre($this->faker->firstName);
            $user->setPassword($this->userPasswordEncoder->encodePassword(
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
            $user->setPassword($this->userPasswordEncoder->encodePassword(
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
            $user->setPassword($this->userPasswordEncoder->encodePassword(
                $user,
                'Ninguna'
            ));
            $user->aceptaTerminos();

            return $user;
        });

        $manager->flush();
    }
}
