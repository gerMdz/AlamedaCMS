<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MetaBaseRepository")
 */
class MetaBase
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lema;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lemaPrincipal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaDescripcion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $metaAutor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaUrl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLema(): ?string
    {
        return $this->lema;
    }

    public function setLema(?string $lema): self
    {
        $this->lema = $lema;

        return $this;
    }

    public function getLemaPrincipal(): ?string
    {
        return $this->lemaPrincipal;
    }

    public function setLemaPrincipal(string $lemaPrincipal): self
    {
        $this->lemaPrincipal = $lemaPrincipal;

        return $this;
    }

    public function getMetaDescripcion(): ?string
    {
        return $this->metaDescripcion;
    }

    public function setMetaDescripcion(string $metaDescripcion): self
    {
        $this->metaDescripcion = $metaDescripcion;

        return $this;
    }

    public function getMetaAutor(): ?string
    {
        return $this->metaAutor;
    }

    public function setMetaAutor(?string $metaAutor): self
    {
        $this->metaAutor = $metaAutor;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaType(): ?string
    {
        return $this->metaType;
    }

    public function setMetaType(string $metaType): self
    {
        $this->metaType = $metaType;

        return $this;
    }

    public function getMetaUrl(): ?string
    {
        return $this->metaUrl;
    }

    public function setMetaUrl(string $metaUrl): self
    {
        $this->metaUrl = $metaUrl;

        return $this;
    }
}
