<?php

namespace App\DataFixtures;

use App\Entity\IndexAlameda;
use App\Entity\MetaBase;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->creaDatosIndex($manager);
    }

    private function creaDatosIndex(ObjectManager $manager)
    {
        $inicio = new IndexAlameda();
        $inicio->setLema('Oraciones Audaces');
        $inicio->setLemaPrincipal('Vení tal como sos');
        $inicio->setLemaSinEspacio('Oraciones-Audaces');
        $inicio->setMetaAutor('Desarrollo Alameda');
        $inicio->setMetaDescripcion('Jesús, Dios, Igelsia, Amor, Esperanza, Fe, Arte');
        $inicio->setMetaTitle('Iglesia Alameda');
        $inicio->setMetaImage('cabecera_index.jpg');
        $inicio->setMetaType('website');
        $inicio->setMetaUrl('https://alamedacms.com');
        $inicio->setBase('index');

        $base = new MetaBase();
        $base->setBase('index');
        $base->setLema('Oraciones Audaces');
        $base->setLemaPrincipal('Vení tal como sos');
        $base->setMetaAutor('Diseño Alameda');
        $base->setMetaDescripcion('Jesús, Dios, Igelsia, Amor, Esperanza, Fe, Arte');
        $base->setMetaTitle('Iglesia de la Alameda');
        $base->setMetaType('website');
        $base->setMetaUrl('https://iglesiaalameda.com');
        $base->setSiteName('Iglesia Alameda');

        $manager->persist($inicio);
        $manager->persist($base);

        $manager->flush();
    }
}
