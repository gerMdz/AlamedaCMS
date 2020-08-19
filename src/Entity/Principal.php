<?php

namespace App\Entity;

use App\Repository\PrincipalRepository;
use App\Service\UploaderHelper;
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

    /**
     * @ORM\OneToMany(targetEntity=Brote::class, mappedBy="principal")
     */
    private $brotes;

    /**
     * @ORM\ManyToOne(targetEntity=Principal::class, inversedBy="principals")
     */
    private $bud;

    /**
     * @ORM\OneToMany(targetEntity=Principal::class, mappedBy="bud")
     */
    private $principals;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->entradas = new ArrayCollection();
        $this->brotes = new ArrayCollection();
        $this->principals = new ArrayCollection();
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

    /**
     * @return Collection|Brote[]
     */
    public function getBrotes(): Collection
    {
        return $this->brotes;
    }

    public function addbrote(Brote $brote): self
    {
        if (!$this->brotes->contains($brote)) {
            $this->brotes[] = $brote;
            $brote->setPrincipal($this);
        }

        return $this;
    }

    public function removebrote(Brote $brote): self
    {
        if ($this->brotes->contains($brote)) {
            $this->brotes->removeElement($brote);
            // set the owning side to null (unless already changed)
            if ($brote->getPrincipal() === $this) {
                $brote->setPrincipal(null);
            }
        }

        return $this;
    }
    public function getImagePath()
    {
        return UploaderHelper::IMAGE_ENTRADA.'/'.$this->getImageFilename();
    }

    public function getBud(): ?self
    {
        return $this->bud;
    }

    public function setBud(?self $bud): self
    {
        $this->bud = $bud;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getPrincipals(): Collection
    {
        return $this->principals;
    }

    public function addPrincipal(self $principal): self
    {
        if (!$this->principals->contains($principal)) {
            $this->principals[] = $principal;
            $principal->setBud($this);
        }

        return $this;
    }

    public function removePrincipal(self $principal): self
    {
        if ($this->principals->contains($principal)) {
            $this->principals->removeElement($principal);
            // set the owning side to null (unless already changed)
            if ($principal->getBud() === $this) {
                $principal->setBud(null);
            }
        }

        return $this;
    }
}
