<?php

namespace App\Entity;

use App\Repository\ButtonLinkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ButtonLinkRepository::class)
 */
class ButtonLink
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cssClass;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $linkRoute;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isLinkExterno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textButton;

    /**
     * @ORM\ManyToMany(targetEntity=Section::class, mappedBy="button")
     */
    private $sections;

    /**
     * @ORM\ManyToMany(targetEntity=Principal::class, mappedBy="button")
     */
    private $principals;

    /**
     * @ORM\ManyToMany(targetEntity=Entrada::class, mappedBy="button")
     */
    private $entradas;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
        $this->principals = new ArrayCollection();
        $this->entradas = new ArrayCollection();
    }

    public function __toString()
    {
     return $this->textButton;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getLinkRoute(): ?string
    {
        return $this->linkRoute;
    }

    public function setLinkRoute(string $linkRoute): self
    {
        $this->linkRoute = $linkRoute;

        return $this;
    }

    public function getIsLinkExterno(): ?bool
    {
        return $this->isLinkExterno;
    }

    public function setIsLinkExterno(?bool $isLinkExterno): self
    {
        $this->isLinkExterno = $isLinkExterno;

        return $this;
    }

    public function getTextButton(): ?string
    {
        return $this->textButton;
    }

    public function setTextButton(string $textButton): self
    {
        $this->textButton = $textButton;

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
            $section->addButton($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->sections->removeElement($section)) {
            $section->removeButton($this);
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
            $principal->addButton($this);
        }

        return $this;
    }

    public function removePrincipal(Principal $principal): self
    {
        if ($this->principals->removeElement($principal)) {
            $principal->removeButton($this);
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
            $entrada->addButton($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->removeElement($entrada)) {
            $entrada->removeButton($this);
        }

        return $this;
    }
}
