<?php

namespace App\Entity;

use App\Repository\ContactoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactoRepository::class)]
class Contacto implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(inversedBy: 'contactos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TipoContacto $tipo = null;

    #[ORM\Column(type: 'string', length: 255)]
    private $linkRoute;

    #[ORM\Column(type: 'string', length: 510, nullable: true)]
    private $textoMensaje;

    #[ORM\Column(type: 'string', length: 510, nullable: true)]
    private $textoPagina;

    #[ORM\ManyToMany(targetEntity: Ministerio::class, inversedBy: 'contactos')]
    private $ministerio;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\ManyToMany(targetEntity: Entrada::class, mappedBy: 'contacto')]
    private $entradas;

    public function __construct()
    {
        $this->ministerio = new ArrayCollection();
        $this->entradas = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->nombre;
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
    public function getMinisterio(): Collection
    {
        return $this->ministerio;
    }

    public function addMinisterio(Ministerio $ministerio): self
    {
        if (!$this->ministerio->contains($ministerio)) {
            $this->ministerio[] = $ministerio;
        }

        return $this;
    }

    public function removeMinisterio(Ministerio $ministerio): self
    {
        $this->ministerio->removeElement($ministerio);

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

    /**
     * @return Collection|Entrada[]
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entrada $entrada): self
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas[] = $entrada;
            $entrada->addContacto($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->removeElement($entrada)) {
            $entrada->removeContacto($this);
        }

        return $this;
    }
}
