<?php

namespace App\Twig;

use App\Entity\IndexAlameda;
use App\Entity\MetaBase;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class BaseExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    protected $em;
    private $container;

    /**
     * BaseExtension constructor.
     * @param EntityManagerInterface $em
     * @param ContainerInterface $container
     */
    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('base_lema', [$this, 'lema']),
            new TwigFunction('base_metaDescripcion', [$this, 'metaDescripcion']),
            new TwigFunction('base_base', [$this, 'base']),
            new TwigFunction('uploaded_asset', [$this, 'getUploadedAssetPath'])
        ];
    }

    public function lema()
    {
        $lema = $this->em->getRepository(IndexAlameda::class)->findOneBy(['base'=>'index']);

        return $lema->getLema();
    }

    public function metaDescripcion()
    {
        $base = $this->em->getRepository(IndexAlameda::class)->findOneBy(['base'=>'index']);

        return $base->getMetaDescripcion();
    }

    public function base()
    {
        $base = $this->em->getRepository(MetaBase::class)->findOneBy(['base'=>'index']);

        return $base;
    }

    public function getUploadedAssetPath(string $path): string
    {
        return $this->container
            ->get(UploaderHelper::class)
            ->getPublicPath($path);
    }

    public static function getSubscribedServices()
    {
        return [
            UploaderHelper::class,
        ];
    }
}
