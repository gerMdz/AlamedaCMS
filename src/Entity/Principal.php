<?php

namespace App\Entity;

use App\Entity\Traits\ImageTrait;
use App\Repository\PrincipalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PrincipalRepository::class)
 */
class Principal
{

    use TimestampableEntity;
    use ImageTrait;

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
     * @Assert\NotBlank(message="El título de la página, no debe estar en blanco")
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

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="principal")
     */
    private $section;

    /**
     * @ORM\ManyToOne(targetEntity=Principal::class, inversedBy="brote")
     */
    private $principal;

    /**
     * @ORM\OneToMany(targetEntity=Principal::class, mappedBy="principal")
     */
    private $brote;

    /**
     * @ORM\ManyToOne(targetEntity=ModelTemplate::class, inversedBy="principals")
     */
    private $modelTemplate;

    /**
     * @ORM\ManyToOne(targetEntity=Ministerio::class, inversedBy="page")
     */
    private $ministerio;


    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->entradas = new ArrayCollection();
        $this->section = new ArrayCollection();
        $this->brote = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titulo;
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
        ($linkRoute == null ? $linkRoute = strtolower(str_replace(' ', '-', trim($this->titulo . '-' . $this->id))) : $linkRoute);
        $this->linkRoute = $linkRoute;
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





    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(Section $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
            $section->setPrincipal($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->section->contains($section)) {
            $this->section->removeElement($section);
            // set the owning side to null (unless already changed)
            if ($section->getPrincipal() === $this) {
                $section->setPrincipal(null);
            }
        }

        return $this;
    }

    public function getPrincipal(): ?self
    {
        return $this->principal;
    }

    public function setPrincipal(?self $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getBrote(): Collection
    {
        return $this->brote;
    }

    public function addBrote(self $brote): self
    {
        if (!$this->brote->contains($brote)) {
            $this->brote[] = $brote;
            $brote->setPrincipal($this);
        }

        return $this;
    }

    public function removeBrote(self $brote): self
    {
        if ($this->brote->contains($brote)) {
            $this->brote->removeElement($brote);
            // set the owning side to null (unless already changed)
            if ($brote->getPrincipal() === $this) {
                $brote->setPrincipal(null);
            }
        }

        return $this;
    }

    public function getModelTemplate(): ?ModelTemplate
    {
        return $this->modelTemplate;
    }

    public function setModelTemplate(?ModelTemplate $modelTemplate): self
    {
        $this->modelTemplate = $modelTemplate;

        return $this;
    }

    public function getMinisterio(): ?Ministerio
    {
        return $this->ministerio;
    }

    public function setMinisterio(?Ministerio $ministerio): self
    {
        $this->ministerio = $ministerio;

        return $this;
    }


}
