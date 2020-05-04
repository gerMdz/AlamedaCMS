<?php

namespace App\Twig;

use App\Entity\IndexAlameda;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class BaseExtension extends AbstractExtension
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
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
        $base = $this->em->getRepository(IndexAlameda::class)->findOneBy(['base'=>'index']);

        return $base;
    }
}
