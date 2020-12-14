<?php

namespace App\Twig;

use App\Entity\IndexAlameda;
use App\Entity\Invitado;
use App\Entity\MetaBase;
use App\Service\UploaderHelper;
use Doctrine\ORM\EntityManagerInterface;
use InvalidArgumentException;
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
            new TwigFunction('uploaded_asset', [$this, 'getUploadedAssetPath']),
            new TwigFunction('capacidad_restante', [$this, 'capacidad_restante']),
            new TwigFunction('capacidad_ocupada', [$this, 'capacidad_ocupada']),
            new TwigFunction('redirection', [$this, 'redirection']),
        ];
    }

    public function lema()
    {
        $lema = $this->em->getRepository(IndexAlameda::class)->findOneBy(['base' => 'index']);

        return $lema->getLema();
    }

    public function metaDescripcion()
    {
        $base = $this->em->getRepository(IndexAlameda::class)->findOneBy(['base' => 'index']);

        return $base->getMetaDescripcion();
    }

    public function base()
    {
        //        $base = $this->em->getRepository(MetaBase::class)->findOneBy(['base'=>'index']);

        return $this->container->get(EntityManagerInterface::class)->getRepository(MetaBase::class)->findOneBy(['base' => 'index']);
    }


    public function getUploadedAssetPath(string $path): string
    {
        return $this->container
            ->get(UploaderHelper::class)
            ->getPublicPath($path);
    }

    public function capacidad_restante(string $celebracion, int $cantidad)
    {
        $invitados = $this->container->get(EntityManagerInterface::class)->getRepository(Invitado::class)->countByCelebracion($celebracion);
        return $cantidad - $invitados;
    }

    public function capacidad_ocupada(string $celebracion)
    {
        return $this->container->get(EntityManagerInterface::class)->getRepository(Invitado::class)->countByCelebracion($celebracion);
    }

    public static function getSubscribedServices()
    {
        return [
            UploaderHelper::class,
            EntityManagerInterface::class,
        ];
    }

    public function redirection(string $link)
    {
        if ('' === ($link ?? '')) {
            throw new InvalidArgumentException('No se puede redireccionar a una URL vacía.');
        }

        echo "<meta http-equiv = 'refresh' content='0;url = $link' />";

    }
}
