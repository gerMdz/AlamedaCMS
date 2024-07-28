<?php

namespace App\DataFixtures;

use App\Entity\TypeBlock;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class TypeBlockFixture extends Fixture implements FixtureGroupInterface
{

    public const TYPE_BLOCK = [
        ['page', 'Página visible, landing', 'page', true],
        ['seccion', 'Partes de una page, secciones', 'seccion', true],
        ['entrada', 'Parte de una sección, normalmente donde se escribe', 'entrada', true],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TYPE_BLOCK as $typeBlock) {
            $tB = new TypeBlock();
            $tB->setName($typeBlock[0])
                ->setIdentifier($typeBlock[2])
                ->setDescription($typeBlock[1])
                ->setIsActive($typeBlock[3]);
            $manager->persist($tB);
        }
        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['groupTypeBlock'];
    }
}
