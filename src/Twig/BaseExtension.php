<?php

namespace App\Twig;

use App\Entity\IndexAlameda;
use App\Entity\Invitado;
use App\Entity\MetaBase;
use App\Entity\NewsSite;
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
    protected $ind_inicio = "{{";
    protected $ind_final = "}}";

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
            new TwigFunction('completa_texto', [$this, 'completa_texto']),
            new TwigFunction('completa_lugar', [$this, 'completa_lugar']),
            new TwigFunction('form_suscripto_newsletter', [$this, 'form_suscripto_newsletter']),
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

    public function completa_texto(string $campo)
    {

        $encontro = false;

        $i = 0;
        do {

            $inicio = strpos($campo, $this->ind_inicio);

            if ($inicio !== false) {
                $fin = strpos($campo, $this->ind_final);
                $servicio = substr($campo,
                    ($inicio + strlen($this->ind_inicio)),
                    $fin - ($inicio + strlen($this->ind_inicio)));
                $campo = str_replace($this->ind_inicio . $servicio . $this->ind_final,
                    $this->addTexto(trim($servicio)), $campo);

                $encontro = true;
            } else {
                $encontro = false;
            }

        } while ($encontro && $i < 10);
        return $campo;

    }

    public function completa_lugar(string $lugar): string
    {
        return $this->addTexto(trim($lugar));

    }

    private function addTexto($valor): string
    {
        $texto = '<small><i class="fa fa-star" id="xp%s"> </i></small>
    <label id="lp%s"> </label>
    <label id="sinp%s">
        <input id="p%s" class="input-group-sm " placeholder="puedes completar aquí">
    </label>';

        return sprintf($texto, $valor, $valor, $valor, $valor);
    }

    public function form_suscripto_newsletter(string $type,string $fuente): string
    {
        switch ($type){
            case 'script':
            default:
                return $this->divScript($fuente);
        }
    }

    /**
     * @param string $fuente
     * @return string
     */
    protected function divScript(string $fuente): string
    {
        $crea_formulario = $this->container->get(EntityManagerInterface::class)
            ->getRepository(NewsSite::class)
            ->findBy(['srcType' =>'script', 'srcSite' => $fuente]);

        return $crea_formulario[0]->getSrcCodigo();
    }

}
