<?php

namespace App\Entity;

use App\Repository\EntradaReferenceRepository;
use App\Service\UploaderHelper;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EntradaReferenceRepository::class)]
class EntradaReference
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('main')]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups('main')]
    private ?string $filename;

    #[ORM\Column]
    #[Groups(['main', 'input'])]
    #[Assert\NotBlank]
    #[Assert\Length(max: '100')]
    private ?string $originalFilename;

    #[ORM\Column]
    #[Groups('main')]
    private ?string $mimeType;

    #[ORM\Column(nullable: true)]
    private ?int $posicion = 0;

    public function __construct(
        #[ORM\ManyToOne(targetEntity: Entrada::class, inversedBy: 'entradaReferences')]
        private Entrada $entrada
    ) {
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

    public function getoriginalFilename(): ?string
    {
        return $this->originalFilename;
    }

    public function setoriginalFilename(string $originalFilename): self
    {
        $this->originalFilename = $originalFilename;

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

    public function getImagePath(): string
    {
        return UploaderHelper::ENTRADA_REFERENCE.'/'.$this->getFilename();
    }

    public function getPosicion(): ?int
    {
        return $this->posicion;
    }

    public function setPosicion(?int $posicion): self
    {
        $this->posicion = $posicion;

        return $this;
    }
}
