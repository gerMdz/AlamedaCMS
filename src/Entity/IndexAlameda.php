<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?string $lema;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $lemaPrincipal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $lemaSinEspacio;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $horario1;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private ?string $horario2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $textoVersiculo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $versiculo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaDescripcion;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaAutor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaType;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $metaImage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $base;

    /**
     * @ORM\ManyToMany(targetEntity=Section::class, inversedBy="indexAlamedas")
     * @ORM\OrderBy({"orden"="ASC"})
     */
    private $section;

    /**
     * @ORM\OneToMany(targetEntity=BlocsFixes::class, mappedBy="indexAlameda")
     */
    private Collection $blocs_fixes;

    /**
     * @ORM\ManyToOne(targetEntity=ModelTemplate::class)
     */
    private ?ModelTemplate $template;

    public function __construct()
    {
        $this->section = new ArrayCollection();
        $this->blocs_fixes = new ArrayCollection();
    }
    public function __toString()
    {
     return $this->base;
    }

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

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(string $base): self
    {
        $this->base = $base;

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
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->section->contains($section)) {
            $this->section->removeElement($section);
        }

        return $this;
    }

    /**
     * @return ArrayCollection<int, BlocsFixes>
     */
    public function getBlocsFixes(): Collection
    {
        return $this->blocs_fixes;
    }

    /**
     * @param BlocsFixes $blocsFix
     * @return $this
     */
    public function addBlocsFix(BlocsFixes $blocsFix): self
    {
        if (!$this->blocs_fixes->contains($blocsFix)) {
            $this->blocs_fixes[] = $blocsFix;
            $blocsFix->setIndexAlameda($this);
        }

        return $this;
    }

    public function removeBlocsFix(BlocsFixes $blocsFix): self
    {
        if ($this->blocs_fixes->removeElement($blocsFix)) {
            // set the owning side to null (unless already changed)
            if ($blocsFix->getIndexAlameda() === $this) {
                $blocsFix->setIndexAlameda(null);
            }
        }

        return $this;
    }

    public function getTemplate(): ?ModelTemplate
    {
        return $this->template;
    }

    public function setTemplate(?ModelTemplate $template): self
    {
        $this->template = $template;

        return $this;
    }
}
