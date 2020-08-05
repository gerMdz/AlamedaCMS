<?php

namespace App\Entity;

use App\Entity\Traits\OfertTrait;
use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
{
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cssClass;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $identificador;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disponible;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $columns;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $disponibleAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOrigin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeSecondary;

    /**
     * @ORM\ManyToMany(targetEntity=IndexAlameda::class, mappedBy="section")
     */
    private $indexAlamedas;

    /**
     * @ORM\ManyToMany(targetEntity=Entrada::class, mappedBy="section")
     */
    private $entradas;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->indexAlamedas = new ArrayCollection();
        $this->entradas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCssClass(): ?string
    {
        return $this->cssClass;
    }

    public function setCssClass(?string $cssClass): self
    {
        $this->cssClass = $cssClass;

        return $this;
    }

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    public function setIdentificador(?string $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(?bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getColumns(): ?int
    {
        return $this->columns;
    }

    public function setColumns(?int $columns): self
    {
        $this->columns = $columns;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDisponibleAt(): ?\DateTimeInterface
    {
        return $this->disponibleAt;
    }

    public function setDisponibleAt(?\DateTimeInterface $disponibleAt): self
    {
        $this->disponibleAt = $disponibleAt;

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

    public function getTypeSecondary(): ?string
    {
        return $this->typeSecondary;
    }

    public function setTypeSecondary(?string $typeSecondary): self
    {
        $this->typeSecondary = $typeSecondary;

        return $this;
    }

    /**
     * @return Collection|IndexAlameda[]
     */
    public function getIndexAlamedas(): Collection
    {
        return $this->indexAlamedas;
    }

    public function addIndexAlameda(IndexAlameda $indexAlameda): self
    {
        if (!$this->indexAlamedas->contains($indexAlameda)) {
            $this->indexAlamedas[] = $indexAlameda;
            $indexAlameda->addSection($this);
        }

        return $this;
    }

    public function removeIndexAlameda(IndexAlameda $indexAlameda): self
    {
        if ($this->indexAlamedas->contains($indexAlameda)) {
            $this->indexAlamedas->removeElement($indexAlameda);
            $indexAlameda->removeSection($this);
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
            $entrada->addSection($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->contains($entrada)) {
            $this->entradas->removeElement($entrada);
            $entrada->removeSection($this);
        }

        return $this;
    }
}
