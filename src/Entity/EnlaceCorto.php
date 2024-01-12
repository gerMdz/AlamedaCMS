<?php

namespace App\Entity;

use App\Repository\EnlaceCortoRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: EnlaceCortoRepository::class)]
class EnlaceCorto
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Gedmo\Slug(fields: ['linkRoute'])]
    #[ORM\Column(type: 'string', length: 150, unique: true, nullable: true)]
    private $linkRoute;

    #[ORM\Column(type: 'string', length: 255)]
    private $urlDestino;

    #[ORM\ManyToOne(inversedBy: 'enlaceCortos')]
    private ?User $usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLinkRoute(): ?string
    {
        return $this->linkRoute;
    }

    public function setLinkRoute(string $linkRoute): self
    {
        $this->linkRoute = $linkRoute;

        return $this;
    }

    public function getUrlDestino(): ?string
    {
        return $this->urlDestino;
    }

    public function setUrlDestino(string $urlDestino): self
    {
        $this->urlDestino = $urlDestino;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }
}
