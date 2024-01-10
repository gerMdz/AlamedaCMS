<?php

namespace App\Entity;

use App\Repository\RelacionSectionEntradaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RelacionSectionEntradaRepository::class)]
class RelacionSectionEntrada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Section::class, inversedBy: 'relacionSectionEntradas')]
    private ?Section $section = null;

    #[ORM\ManyToOne(targetEntity: Entrada::class, inversedBy: 'relacionSectionEntradas')]
    private ?Entrada $entrada = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $orden;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getEntrada(): ?Entrada
    {
        return $this->entrada;
    }

    public function setEntrada(?Entrada $entrada): self
    {
        $this->entrada = $entrada;

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
