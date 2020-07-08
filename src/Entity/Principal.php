<?php

namespace App\Entity;

use App\Repository\PrincipalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=PrincipalRepository::class)
 */
class Principal
{

    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="principal")
     * @ORM\JoinColumn(nullable=false)
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
     * @ORM\Column(type="string", length=150, unique=true, nullable=true)
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
     * @ORM\OneToMany(targetEntity=Comentario::class, mappedBy="principal")
     */
    private $comentarios;

    /**
     * @ORM\ManyToMany(targetEntity=Entrada::class, inversedBy="principals")
     */
    private $entradas;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->entradas = new ArrayCollection();
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

    public function setLinkRoute(?string $linkRoute): self
    {
        ($linkRoute ==null ? $linkRoute = strtolower(str_replace(' ', '-', trim($this->titulo().'-'.$this->gId()))) : $linkRoute = $linkRoute);
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
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setPrincipal($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getPrincipal() === $this) {
                $comentario->setPrincipal(null);
            }
        }

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
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->contains($entrada)) {
            $this->entradas->removeElement($entrada);
        }

        return $this;
    }
}
