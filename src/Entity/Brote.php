<?php

namespace App\Entity;

use App\Entity\Traits\OfertTrait;
use App\Repository\BroteRepository;
use App\Service\UploaderHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BroteRepository::class)
 */
class Brote
{
    use TimestampableEntity;
    use OfertTrait;

    /**
     * @ORM\Id()
     *
     * @ORM\GeneratedValue()
     *
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="derivadas")
     *
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\NotNull(message="Por favor indique autor")
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=2550)
     */
    private $contenido;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     *
     * @Gedmo\Slug(fields={"titulo"})
     */
    private $linkRoute;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $likes;

    /**
     * @ORM\OneToMany(targetEntity=Comentario::class, mappedBy="derivada")
     */
    private $comenttarios;

    /**
     * @ORM\ManyToMany(targetEntity=Entrada::class, inversedBy="derivadas")
     */
    private $entrada;

    /**
     * @ORM\ManyToOne(targetEntity=Principal::class, inversedBy="derivadas")
     */
    private $principal;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publicadoAt;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $activa;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eventoAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkPosting;

    public function __construct()
    {
        $this->comenttarios = new ArrayCollection();
        $this->entrada = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutor(): ?User
    {
        return $this->autor;
    }

    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

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

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComenttarios(): Collection
    {
        return $this->comenttarios;
    }

    public function addComenttario(Comentario $comenttario): self
    {
        if (!$this->comenttarios->contains($comenttario)) {
            $this->comenttarios[] = $comenttario;
            $comenttario->setDerivada($this);
        }

        return $this;
    }

    public function removeComenttario(Comentario $comenttario): self
    {
        if ($this->comenttarios->contains($comenttario)) {
            $this->comenttarios->removeElement($comenttario);
            // set the owning side to null (unless already changed)
            if ($comenttario->getDerivada() === $this) {
                $comenttario->setDerivada(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entrada[]
     */
    public function getEntrada(): Collection
    {
        return $this->entrada;
    }

    public function addEntrada(Entrada $entrada): self
    {
        if (!$this->entrada->contains($entrada)) {
            $this->entrada[] = $entrada;
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entrada->contains($entrada)) {
            $this->entrada->removeElement($entrada);
        }

        return $this;
    }

    public function getPrincipal(): ?Principal
    {
        return $this->principal;
    }

    public function setPrincipal(?Principal $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    public function getPublicadoAt(): ?\DateTimeInterface
    {
        return $this->publicadoAt;
    }

    public function setPublicadoAt(?\DateTimeInterface $publicadoAt): self
    {
        $this->publicadoAt = $publicadoAt;

        return $this;
    }

    public function getActiva(): ?bool
    {
        return $this->activa;
    }

    public function setActiva(?bool $activa): self
    {
        $this->activa = $activa;

        return $this;
    }

    public function getImagePath()
    {
        return UploaderHelper::IMAGE_ENTRADA.'/'.$this->getImageFilename();
    }

    public function getEventoAt(): ?\DateTimeInterface
    {
        return $this->eventoAt;
    }

    public function setEventoAt(?\DateTimeInterface $eventoAt): self
    {
        $this->eventoAt = $eventoAt;

        return $this;
    }

    public function getLinkPosting(): ?string
    {
        return $this->linkPosting;
    }

    public function setLinkPosting(?string $linkPosting): self
    {
        $this->linkPosting = $linkPosting;

        return $this;
    }
}
