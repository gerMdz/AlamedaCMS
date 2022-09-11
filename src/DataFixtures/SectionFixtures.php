<?php

namespace App\DataFixtures;

use App\Entity\Section;
use App\Service\UploaderHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class SectionFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $sectionTitles = [
        'Ejmplo1',
        'Ejmplo2',
        'Ejmplo3',
        'Ejmplo4',

    ];
    private static $sectionImages = [
        '01-Ante-lo-inesperado.jpg',
        '02-Indomita.jpg',
        '03-Rescate-en-las-llamas.jpg',
    ];
    private UploaderHelper $uploaderHelper;

    /**
     * @param UploaderHelper $uploaderHelper
     */
    public function __construct(UploaderHelper $uploaderHelper)
    {
        $this->uploaderHelper = $uploaderHelper;
    }

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(10, 'main_section', function ($count) use ($manager) {
            $section = new Section();
            $section->setTitle($this->faker->randomElement(self::$sectionTitles))
                ->setContenido($this->faker->realText(100))
                ->setDescription('Perfecta descripción')
                ->setName('Gran Nombre')
                ->setFooter('Un excelente final');
            $section->setIdentificador(strtolower($section->getTitle()));
            // publish most articles

            $imageFilename = $this->fakeUploadImage();

            $section->setAutor($this->getRandomReference('escitor_users'))
                ->setImageFilename($imageFilename);
            $section->addEntrada($this->getRandomReference('main_entradas'));

            return $section;
        });

        $manager->flush();
    }

    private function fakeUploadImage(): string
    {
        $randomImage = $this->faker->randomElement(self::$sectionImages);
        $fs = new Filesystem();
        $targetPath = sys_get_temp_dir().'/'.$randomImage;
        $fs->copy(__DIR__.'/images/'.$randomImage, $targetPath, true);

        return $this->uploaderHelper
            ->uploadEntradaImage(new File($targetPath), false);
    }


    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            EntradaFixtures::class,
        ];
    }
}