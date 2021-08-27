<?php

namespace App\Entity;

use App\Repository\NewsSiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * @ORM\Entity(repositoryClass=NewsSiteRepository::class)
 */
class NewsSite
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $srcSite;

    /**
     * @ORM\Column(type="string", length=510)
     */
    private $srcCodigo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isEnabled;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $srcType;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $srcParameters;

    /**
     * @ORM\Column(type="string", length=155, unique=true )
     */
    private $identificador;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    public function __toString()
    {
        return $this->getIdentificador();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getSrcSite(): ?string
    {
        return $this->srcSite;
    }

    public function setSrcSite(string $srcSite): self
    {
        $this->srcSite = $srcSite;

        return $this;
    }

    public function getSrcCodigo(): ?string
    {
        return $this->srcCodigo;
    }

    public function setSrcCodigo(string $srcCodigo): self
    {
        $this->srcCodigo = $srcCodigo;

        return $this;
    }

    public function getIsEnabled(): ?bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(?bool $isEnabled): self
    {
        $this->isEnabled = $isEnabled;

        return $this;
    }

    public function getSrcType(): ?string
    {
        return $this->srcType;
    }

    public function setSrcType(string $srcType): self
    {
        $this->srcType = $srcType;

        return $this;
    }

    public function getSrcParameters(): ?string
    {
        return $this->srcParameters;
    }

    public function setSrcParameters(?string $srcParameters): self
    {
        $this->srcParameters = $srcParameters;

        return $this;
    }

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    public function setIdentificador(?string $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }
}
