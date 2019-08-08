<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IndexAlamedaRepository")
 */
class IndexAlameda
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
    private $lema;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lemaPrincipal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lemaSinEspacio;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $horario1;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $horario2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $textoVersiculo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $versiculo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaDescripcion;

    /**
     * @ORM\Column(type="string", length=255)
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

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $metaImage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLema(): ?string
    {
        return $this->lema;
    }

    public function setLema(string $lema): self
    {
        $this->lema = $lema;

        return $this;
    }

    public function getLemaPrincipal(): ?string
    {
        return $this->lemaPrincipal;
    }

    public function setLemaPrincipal(?string $lemaPrincipal): self
    {
        $this->lemaPrincipal = $lemaPrincipal;

        return $this;
    }

    public function getLemaSinEspacio(): ?string
    {
        return $this->lemaSinEspacio;
    }

    public function setLemaSinEspacio(string $lemaSinEspacio): self
    {
        $this->lemaSinEspacio = $lemaSinEspacio;

        return $this;
    }

    public function getHorario1(): ?string
    {
        return $this->horario1;
    }

    public function setHorario1(?string $horario1): self
    {
        $this->horario1 = $horario1;

        return $this;
    }

    public function getHorario2(): ?string
    {
        return $this->horario2;
    }

    public function setHorario2(?string $horario2): self
    {
        $this->horario2 = $horario2;

        return $this;
    }

    public function getTextoVersiculo(): ?string
    {
        return $this->textoVersiculo;
    }

    public function setTextoVersiculo(?string $textoVersiculo): self
    {
        $this->textoVersiculo = $textoVersiculo;

        return $this;
    }

    public function getVersiculo(): ?string
    {
        return $this->versiculo;
    }

    public function setVersiculo(?string $versiculo): self
    {
        $this->versiculo = $versiculo;

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

    public function setMetaAutor(string $metaAutor): self
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

    public function getMetaImage(): ?string
    {
        return $this->metaImage;
    }

    public function setMetaImage(string $metaImage): self
    {
        $this->metaImage = $metaImage;

        return $this;
    }
}
