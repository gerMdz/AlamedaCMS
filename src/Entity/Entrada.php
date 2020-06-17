<?php

namespace App\Entity;

use App\Service\UploaderHelper;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntradaRepository")
 */
class Entrada
{
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
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $creadaAt;

    /**
     * @Gedmo\Slug(fields={"titulo"})
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     */
    private $linkRoute;

    /**
     * @ORM\OneToMany(targetEntity=EntradaReference::class, mappedBy="entrada")
     */
    private $entradaReferences;

    /**
     * @ORM\Column(type="integer")
     */
    private $likes = 0;

    public function __construct()
    {
        $this->creadaAt = new DateTime('now');
        $this->entradaReferences = new ArrayCollection();
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

    public function getPublicadoAt(): ?\DateTimeInterface
    {
        return $this->publicadoAt;
    }

    public function setPublicadoAt(?\DateTimeInterface $publicadoAt): self
    {
        $this->publicadoAt = $publicadoAt;

        return $this;
    }

    public function getImagePath()
    {
        return UploaderHelper::IMAGE_ENTRADA.'/'.$this->getImageFilename();
    }

    public function getCreadaAt(): ?\DateTimeInterface
    {
        return $this->creadaAt;
    }

    public function setCreadaAt(?\DateTimeInterface $creadaAt): self
    {
        $this->creadaAt = $creadaAt;

        return $this;
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
}
