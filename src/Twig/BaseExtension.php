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
    protected string $ind_inicio = '{{';

    protected string $ind_final = '}}';

    /**
     * BaseExtension constructor.
     */
    public function __construct(private readonly EntityManagerInterface $em, private readonly ContainerInterface $container)
    {
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
            new TwigFunction('base_lema', $this->lema(...)),
            new TwigFunction('base_metaDescripcion', $this->metaDescripcion(...)),
            new TwigFunction('base_base', $this->base(...)),
            new TwigFunction('uploaded_asset', $this->getUploadedAssetPath(...)),
            new TwigFunction('capacidad_restante', $this->capacidad_restante(...)),
            new TwigFunction('capacidad_ocupada', $this->capacidad_ocupada(...)),
            new TwigFunction('redirection', $this->redirection(...)),
            new TwigFunction('completa_texto', $this->completa_texto(...)),
            new TwigFunction('completa_lugar', $this->completa_lugar(...)),
            new TwigFunction('form_suscripto_newsletter', $this->form_suscripto_newsletter(...)),
            new TwigFunction('booleano', $this->booleano(...)),
        ];
    }

    public function lema(): ?string
    {
        $lema = $this->em->getRepository(IndexAlameda::class)->findOneBy(['base' => 'index']);

        return $lema->getLema();
    }

    public function metaDescripcion(): ?string
    {
        $base = $this->em->getRepository(IndexAlameda::class)->findOneBy(['base' => 'index']);
        if ($base) {
            return $base->getMetaDescripcion() ?? '';
        }

        return 'No se ha indicado una paǵina base.';

    }

    public function base()
    {
        //        $base = $this->em->getRepository(MetaBase::class)->findOneBy(['base'=>'index']);

        return $this->container->get(EntityManagerInterface::class)->getRepository(MetaBase::class)->findOneBy(
            ['base' => 'index']
        );
    }

    public function getUploadedAssetPath(string $path): string
    {
        return $this->container
            ->get(UploaderHelper::class)
            ->getPublicPath($path);
    }

    public function capacidad_restante(string $celebracion, int $cantidad): int
    {
        $invitados = $this->container->get(EntityManagerInterface::class)->getRepository(Invitado::class)
            ->countByCelebracion($celebracion);

        return $cantidad - $invitados;
    }

    public function capacidad_ocupada(string $celebracion)
    {
        return $this->container->get(EntityManagerInterface::class)->getRepository(Invitado::class)
            ->countByCelebracion($celebracion);
    }

    public static function getSubscribedServices(): array
    {
        return [
            UploaderHelper::class,
            EntityManagerInterface::class,
        ];
    }

    public function redirection(?string $link = null): void
    {
        if ('' === ($link ?? '')) {
            throw new InvalidArgumentException('No se puede redireccionar a una URL vacía.');
        }

        echo "<meta http-equiv = 'refresh' content='5;url = $link' />";
    }

    public function completa_texto(string $campo): array|string
    {
        do {
            $inicio = strpos($campo, $this->ind_inicio);

            if (false !== $inicio) {
                $fin = strpos($campo, $this->ind_final);
                $servicio = substr($campo,
                    $inicio + strlen($this->ind_inicio),
                    $fin - ($inicio + strlen($this->ind_inicio)));
                $campo = str_replace($this->ind_inicio . $servicio . $this->ind_final,
                    $this->addTexto(trim($servicio)), $campo);

                $encuentro = true;
            } else {
                $encuentro = false;
            }
        } while ($encuentro);

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

    /**
     * @return array|string|void
     */
    public function form_suscripto_newsletter(string $type, string $fuente)
    {
        switch ($type) {
            case 'script':
                return $this->divScript($fuente);
            case 'iframe':
                return $this->divIframe($fuente);
        }
    }

    protected function divScript(string $fuente): string
    {
        $crea_formulario = $this->container->get(EntityManagerInterface::class)
            ->getRepository(NewsSite::class)
            ->findBy(['srcType' => 'script', 'srcSite' => $fuente]);

        return $crea_formulario[0]->getSrcCodigo();
    }

    protected function divIframe(string $fuente): array
    {
        $crea_formulario = $this->container->get(EntityManagerInterface::class)
            ->getRepository(NewsSite::class)
            ->findBy(['srcType' => 'iframe', 'srcSite' => $fuente]);

        return [$crea_formulario[0]->getSrcCodigo(), $crea_formulario[0]->getSrcParameters()];
    }

    public function booleano($data): string
    {
        $icono = '<i class="fa fa-close fa-2x text-danger"> </i>';
        if (true === $data) {
            $icono = '<i class="fa fa-check fa-2x text-success"> </i>';
        }

        return $icono;
    }
}
