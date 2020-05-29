<?php

namespace App\DataFixtures;

use App\Entity\Entrada;
//use App\Entity\Comment;
//use App\Entity\Tag;
use App\Service\UploaderHelper;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class EntradaFixtures extends BaseFixture implements DependentFixtureInterface
{
    private static $entradaTitles = [
        'Ante lo Inesperado',
        'Indomita',
        'Rescate en las llamas',
    ];

    private static $entradaImages = [
        '01-Ante-lo-inesperado.jpg',
        '02-Indomita.jpg',
        '03-Rescate-en-las-llamas.jpg',
    ];

    private $uploaderHelper;

    /**
     * EntradaFixtures constructor.
     * @param UploaderHelper $uploaderHelper
     */
    public function __construct(UploaderHelper $uploaderHelper)
    {
        $this->uploaderHelper = $uploaderHelper;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_articles', function($count) use ($manager) {
            $entrada = new Entrada();
            $entrada->setTitulo($this->faker->randomElement(self::$entradaTitles))
                ->setContenido('Una dato más');

            // publish most articles
            if ($this->faker->boolean(70)) {
                $entrada->setPublicadoAt($this->faker->dateTimeBetween('-100 days', '-1 days'));
            }
            $imageFilename = $this->fakeUploadImage();


            $entrada->setAutor($this->getRandomReference('escitor_users'))
                ->setImageFilename($imageFilename)
            ;

//            $tags = $this->getRandomReferences('main_tags', $this->faker->numberBetween(0, 5));
//            foreach ($tags as $tag) {
//                $article->addTag($tag);
//            }

            return $entrada;
        });

        $manager->flush();
    }

    private function fakeUploadImage(): string
    {
        $randomImage = $this->faker->randomElement(self::$entradaImages);
        $fs = new Filesystem();
        $targetPath = sys_get_temp_dir().'/'.$randomImage;
        $fs->copy(__DIR__.'/images/'.$randomImage, $targetPath, true);
        return $this->uploaderHelper
            ->uploadEntradaImage(new File($targetPath));
    }

    public function getDependencies()
    {
        return [
//            TagFixture::class,
            UserFixtures::class,
        ];
    }
}
