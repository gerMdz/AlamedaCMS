<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
//    public function load(ObjectManager $manager)
//    {
//        // $product = new Product();
//        // $manager->persist($product);
//
//        $manager->flush();
//    }

    protected $pn =

["man", "ger", "ready", "remain", "idle", "shell", "river", "wild", "sharpen", "greed"]
    ;


    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function ($i){

            $user = new User();
            $user->setEmail(sprintf('alameda%d@example.com', $i));
            $user->setPrimerNombre($this->faker->firstName);

            return $user;

        });

        $manager->flush();
    }
}
