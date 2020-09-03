<?php

namespace App\Entity;

use App\Entity\Traits\OfertTrait;
use App\Repository\EntradaRepository;
use App\Service\UploaderHelper;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntradaRepository")
 */
class Entrada
{
    use TimestampableEntity;
    use OfertTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=4000)
     */
    private $contenido;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="entradas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publicadoAt;



    /**
     *
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $linkRoute;

    /**
     * @ORM\OneToMany(targetEntity=EntradaReference::class, mappedBy="entrada")
     * @ORM\OrderBy({"posicion"="ASC"})
     */
    private $entradaReferences;

    /**
     * @ORM\Column(type="integer")
     */
    private $likes = 0;

    /**
     * @ORM\OneToMany(targetEntity=Comentario::class, mappedBy="entrada", fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $comentarios;

    /**
     * @ORM\ManyToMany(targetEntity=Principal::class, mappedBy="entradas")
     */
    private $principals;

    /**
     * @ORM\ManyToMany(targetEntity=Brote::class, mappedBy="entrada")
     */
    private $brotes;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $eventoAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $linkPosting;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOrigin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeCarry;

    /**
     * @ORM\OneToMany(targetEntity=RelacionSectionEntrada::class, mappedBy="entrada")
     */
    private $relacionSectionEntradas;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orden;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="entradassection")
     */
    private $section;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $encabezado;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $destacado;

    public function __construct()
    {
        $this->entradaReferences = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->principals = new ArrayCollection();
        $this->brotes = new ArrayCollection();
        $this->relacionSectionEntradas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->titulo;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAutor(): ?User
    {
        return $this->autor;
    }

    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

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

    public function getPublicadoAt(): ?DateTimeInterface
    {
        return $this->publicadoAt;
    }

    public function setPublicadoAt(?DateTimeInterface $publicadoAt): self
    {
        $this->publicadoAt = $publicadoAt;

        return $this;
    }

    public function getImagePath()
    {
        return UploaderHelper::IMAGE_ENTRADA.'/'.$this->getImageFilename();
    }

    public function getLinkRoute(): ?string
    {
        return $this->linkRoute;
    }

    public function setLinkRoute(?string $linkRoute): self
    {
        $this->linkRoute = $linkRoute;

        return $this;
    }

    /**
     * @return Collection|EntradaReference[]
     */
    public function getEntradaReferences(): Collection
    {
        return $this->entradaReferences;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function incrementaLikeCount(): self
    {
        $this->likes = $this->likes + 1;

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentariosNoDeleted(): Collection
    {
        $criterio = EntradaRepository::createNoDeletedCriteria();
        return $this->comentarios->matching($criterio);
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
            $comentario->setEntrada($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getEntrada() === $this) {
                $comentario->setEntrada(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Principal[]
     */
    public function getPrincipals(): Collection
    {
        return $this->principals;
    }

    public function addPrincipal(Principal $principal): self
    {
        if (!$this->principals->contains($principal)) {
            $this->principals[] = $principal;
            $principal->addEntrada($this);
        }

        return $this;
    }

    public function removePrincipal(Principal $principal): self
    {
        if ($this->principals->contains($principal)) {
            $this->principals->removeElement($principal);
            $principal->removeEntrada($this);
        }

        return $this;
    }

    /**
     * @return Collection|Brote[]
     */
    public function getBrote(): Collection
    {
        return $this->brote;
    }

    public function addBrote(Brote $brote): self
    {
        if (!$this->brotes->contains($brote)) {
            $this->brotes[] = $brote;
            $brote->addEntrada($this);
        }

        return $this;
    }

    public function removebrote(Brote $brote): self
    {
        if ($this->brotes->contains($brote)) {
            $this->brotes->removeElement($brote);
            $brote->removeEntrada($this);
        }

        return $this;
    }

    public function getEventoAt(): ?DateTimeInterface
    {
        return $this->eventoAt;
    }

    public function setEventoAt(?DateTimeInterface $eventoAt): self
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

    public function getTypeOrigin(): ?string
    {
        return $this->typeOrigin;
    }

    public function setTypeOrigin(?string $typeOrigin): self
    {
        $this->typeOrigin = $typeOrigin;

        return $this;
    }

    public function getTypeCarry(): ?string
    {
        return $this->typeCarry;
    }

    public function setTypeCarry(?string $typeCarry): self
    {
        $this->typeCarry = $typeCarry;

        return $this;
    }



    /**
     * @return Collection|RelacionSectionEntrada[]
     */
    public function getRelacionSectionEntradas(): Collection
    {
        return $this->relacionSectionEntradas;
    }

    public function addRelacionSectionEntrada(RelacionSectionEntrada $relacionSectionEntrada): self
    {
        if (!$this->relacionSectionEntradas->contains($relacionSectionEntrada)) {
            $this->relacionSectionEntradas[] = $relacionSectionEntrada;
            $relacionSectionEntrada->setEntrada($this);
        }

        return $this;
    }

    public function removeRelacionSectionEntrada(RelacionSectionEntrada $relacionSectionEntrada): self
    {
        if ($this->relacionSectionEntradas->contains($relacionSectionEntrada)) {
            $this->relacionSectionEntradas->removeElement($relacionSectionEntrada);
            // set the owning side to null (unless already changed)
            if ($relacionSectionEntrada->getEntrada() === $this) {
                $relacionSectionEntrada->setEntrada(null);
            }
        }

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getEncabezado(): ?bool
    {
        return $this->encabezado;
    }

    public function setEncabezado(?bool $encabezado): self
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    public function getDestacado(): ?bool
    {
        return $this->destacado;
    }

    public function setDestacado(?bool $destacado): self
    {
        $this->destacado = $destacado;

        return $this;
    }




}
