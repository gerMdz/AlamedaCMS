<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: 'App\Repository\IndexAlamedaRepository')]
class IndexAlameda implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lema = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $lemaPrincipal = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $lemaSinEspacio = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $metaDescripcion = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $metaAutor = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $metaTitle = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $metaType = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $metaUrl = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $metaImage = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $base = null;

    #[ORM\ManyToMany(targetEntity: Section::class, inversedBy: 'indexAlamedas')]
    #[ORM\OrderBy(['orden' => 'ASC'])]
    private $section;

    #[ORM\OneToMany(targetEntity: BlocsFixes::class, mappedBy: 'indexAlameda')]
    private Collection $blocs_fixes;

    #[ORM\ManyToOne(targetEntity: ModelTemplate::class)]
    private ?ModelTemplate $template = null;

    public function __construct()
    {
        $this->section = new ArrayCollection();
        $this->blocs_fixes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->base;
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
