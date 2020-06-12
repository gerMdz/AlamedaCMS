<?php

namespace App\Entity;

use App\Repository\EntradaReferenceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EntradaReferenceRepository::class)
 */
class EntradaReference
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Entrada::class, inversedBy="entradaReferences")
     */
    private $entrada;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $filename;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orginalFilename;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mimeType;

    public function __construct(Entrada $entrada)
    {
        $this->entrada = $entrada;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrada(): ?Entrada
    {
        return $this->entrada;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getOrginalFilename(): ?string
    {
        return $this->orginalFilename;
    }

    public function setOrginalFilename(string $orginalFilename): self
    {
        $this->orginalFilename = $orginalFilename;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }
}
