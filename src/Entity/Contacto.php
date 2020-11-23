<?php

namespace App\Entity;

use App\Repository\ContactoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContactoRepository::class)
 */
class Contacto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TipoContacto::class, inversedBy="contactos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkRoute;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $textoMensaje;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $textoPagina;

    /**
     * @ORM\ManyToMany(targetEntity=Ministerio::class, inversedBy="contactos")
     */
    private $minsterio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    public function __construct()
    {
        $this->minsterio = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nombre;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?TipoContacto
    {
        return $this->tipo;
    }

    public function setTipo(?TipoContacto $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
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

    public function getTextoMensaje(): ?string
    {
        return $this->textoMensaje;
    }

    public function setTextoMensaje(?string $textoMensaje): self
    {
        $this->textoMensaje = $textoMensaje;

        return $this;
    }

    public function getTextoPagina(): ?string
    {
        return $this->textoPagina;
    }

    public function setTextoPagina(?string $textoPagina): self
    {
        $this->textoPagina = $textoPagina;

        return $this;
    }

    /**
     * @return Collection|Ministerio[]
     */
    public function getMinsterio(): Collection
    {
        return $this->minsterio;
    }

    public function addMinsterio(Ministerio $minsterio): self
    {
        if (!$this->minsterio->contains($minsterio)) {
            $this->minsterio[] = $minsterio;
        }

        return $this;
    }

    public function removeMinsterio(Ministerio $minsterio): self
    {
        $this->minsterio->removeElement($minsterio);

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }


}
