<?php

namespace App\DataFixtures;


use App\Entity\Comentario;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ComentarioFixtures extends BaseFixture implements DependentFixtureInterface
{

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(100, 'main_comentarios', function ($count) {

            $comment = new Comentario();
            $comment->setContenido(
                $this->faker->boolean ? $this->faker->paragraph : $this->faker->sentences(2, true)
            );
            $comment->setAutor($this->getRandomReference('main_users'))
                ->setCreatedAt($this->faker->dateTimeBetween('-1 months', '-1 seconds'))
                ->setEntrada($this->getRandomReference('main_entradas'));

            return $comment;

        });
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
//            TagFixture::class,
            UserFixtures::class,
            EntradaFixtures::class
        ];
}
}