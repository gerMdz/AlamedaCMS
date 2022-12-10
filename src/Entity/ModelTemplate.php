<?php

namespace App\Entity;

use App\Entity\Traits\ImageTrait;
use App\Repository\ModelTemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=ModelTemplateRepository::class)
 */
class ModelTemplate
{
    use ImageTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
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
    private $description;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     */
    private $identifier;

    /**
     * @ORM\ManyToOne(targetEntity=TypeBlock::class, inversedBy="modelTemplates")
     * @ORM\OrderBy({"name"= "ASC"})
     */
    private $block;

    /**
     * @ORM\OneToMany(targetEntity=Principal::class, mappedBy="modelTemplate")
     */
    private $principals;

    /**
     * @ORM\OneToMany(targetEntity=Section::class, mappedBy="modelTemplate")
     */
    private $sections;

    /**
     * @ORM\OneToMany(targetEntity=Entrada::class, mappedBy="modelTemplate")
     */
    private $entradas;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $sizes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $needEntrada;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isContainer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isModelEntrada;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isImage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isImageMultiple;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $showTitle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $showContent;

    public function __construct()
    {
        $this->principals = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->entradas = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->identifier;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getBlock(): ?TypeBlock
    {
        return $this->block;
    }

    public function setBlock(?TypeBlock $block): self
    {
        $this->block = $block;

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
            $principal->setModelTemplate($this);
        }

        return $this;
    }

    public function removePrincipal(Principal $principal): self
    {
        if ($this->principals->contains($principal)) {
            $this->principals->removeElement($principal);
            // set the owning side to null (unless already changed)
            if ($principal->getModelTemplate() === $this) {
                $principal->setModelTemplate(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->setModelTemplate($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
            // set the owning side to null (unless already changed)
            if ($section->getModelTemplate() === $this) {
                $section->setModelTemplate(null);
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
            $entrada->setModelTemplate($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->contains($entrada)) {
            $this->entradas->removeElement($entrada);
            // set the owning side to null (unless already changed)
            if ($entrada->getModelTemplate() === $this) {
                $entrada->setModelTemplate(null);
            }
        }

        return $this;
    }

    public function getSizes(): ?string
    {
        return $this->sizes;
    }

    public function setSizes(?string $sizes): self
    {
        $this->sizes = $sizes;

        return $this;
    }


    public function isNeedEntrada(): ?bool
    {
        return $this->needEntrada;
    }

    public function setNeedEntrada(?bool $needEntrada): self
    {
        $this->needEntrada = $needEntrada;

        return $this;
    }

    public function isIsContainer(): ?bool
    {
        return $this->isContainer;
    }

    public function setIsContainer(?bool $isContainer): self
    {
        $this->isContainer = $isContainer;

        return $this;
    }

    public function isIsModelEntrada(): ?bool
    {
        return $this->isModelEntrada;
    }

    public function setIsModelEntrada(?bool $isModelEntrada): self
    {
        $this->isModelEntrada = $isModelEntrada;

        return $this;
    }

    public function isIsImage(): ?bool
    {
        return $this->isImage;
    }

    public function setIsImage(?bool $isImage): self
    {
        $this->isImage = $isImage;

        return $this;
    }

    public function isIsImageMultiple(): ?bool
    {
        return $this->isImageMultiple;
    }

    public function setIsImageMultiple(?bool $isImageMultiple): self
    {
        $this->isImageMultiple = $isImageMultiple;

        return $this;
    }

    public function isShowTitle(): ?bool
    {
        return $this->showTitle;
    }

    public function setShowTitle(?bool $showTitle): self
    {
        $this->showTitle = $showTitle;

        return $this;
    }

    public function isShowContent(): ?bool
    {
        return $this->showContent;
    }

    public function setShowContent(?bool $showContent): self
    {
        $this->showContent = $showContent;

        return $this;
    }
}
