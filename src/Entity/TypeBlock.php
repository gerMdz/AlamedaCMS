<?php

namespace App\Entity;

use App\Repository\TypeBlockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=TypeBlockRepository::class)
 */
class TypeBlock
{
    /**
     * @ORM\Id
     *
     * @ORM\GeneratedValue
     *
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
     *
     * @Gedmo\Slug(fields={"name"})
     */
    private $identifier;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity=ModelTemplate::class, mappedBy="block")
     */
    private $modelTemplates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $entity;

    public function __construct()
    {
        $this->modelTemplates = new ArrayCollection();
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
     * @return Collection|ModelTemplate[]
     */
    public function getModelTemplates(): Collection
    {
        return $this->modelTemplates;
    }

    public function addModelTemplate(ModelTemplate $modelTemplate): self
    {
        if (!$this->modelTemplates->contains($modelTemplate)) {
            $this->modelTemplates[] = $modelTemplate;
            $modelTemplate->setBlock($this);
        }

        return $this;
    }

    public function removeModelTemplate(ModelTemplate $modelTemplate): self
    {
        if ($this->modelTemplates->contains($modelTemplate)) {
            $this->modelTemplates->removeElement($modelTemplate);
            // set the owning side to null (unless already changed)
            if ($modelTemplate->getBlock() === $this) {
                $modelTemplate->setBlock(null);
            }
        }

        return $this;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(?string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }
}
