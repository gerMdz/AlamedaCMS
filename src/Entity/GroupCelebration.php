<?php

namespace App\Entity;

use App\Entity\Traits\ImageTrait;
use App\Repository\GroupCelebrationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Entity(repositoryClass: GroupCelebrationRepository::class)]
class GroupCelebration implements \Stringable
{
    use TimestampableEntity;

    use ImageTrait;

    #[ORM\Id]
    #[ORM\Column(length: 36)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id;

    #[ORM\Column(nullable: true)]
    private ?bool $isActivo;

    #[ORM\ManyToMany(targetEntity: Celebracion::class, inversedBy: 'groupCelebrations')]
    private Collection $celebraciones;

    #[ORM\Column(nullable: true)]
    private ?string $baseCss;

    #[ORM\Column(nullable: true)]
    private ?string $btonCss;

    #[ORM\Column(nullable: true)]
    private ?string $imageBg;

    #[ORM\Column]
    private ?string $title;

    #[ORM\Column(nullable: true)]
    private ?int $orden;

    public function __construct()
    {
        $this->celebraciones = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->title;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getIsActivo(): ?bool
    {
        return $this->isActivo;
    }

    public function setIsActivo(?bool $isActivo): self
    {
        $this->isActivo = $isActivo;

        return $this;
    }

    /**
     * @return Collection|Celebracion[]
     */
    public function getCelebraciones(): Collection
    {
        return $this->celebraciones;
    }

    public function addCelebracione(Celebracion $celebracione): self
    {
        if (!$this->celebraciones->contains($celebracione)) {
            $this->celebraciones[] = $celebracione;
        }

        return $this;
    }

    public function removeCelebracione(Celebracion $celebracione): self
    {
        $this->celebraciones->removeElement($celebracione);

        return $this;
    }

    public function getBaseCss(): ?string
    {
        return $this->baseCss;
    }

    public function setBaseCss(?string $baseCss): self
    {
        $this->baseCss = $baseCss;

        return $this;
    }

    public function getBtonCss(): ?string
    {
        return $this->btonCss;
    }

    public function setBtonCss(?string $btonCss): self
    {
        $this->btonCss = $btonCss;

        return $this;
    }

    public function getImageBg(): ?string
    {
        return $this->imageBg;
    }

    public function setImageBg(?string $imageBg): self
    {
        $this->imageBg = $imageBg;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
}
