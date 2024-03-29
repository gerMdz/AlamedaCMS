<?php

namespace App\Entity;

use App\Repository\InvitadoRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: InvitadoRepository::class)]
class Invitado implements \Stringable
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups('export_invitado')]
    private ?string $telefono;

    #[ORM\Column(nullable: true)]
    private ?string $dni;

    #[ORM\Column(nullable: true)]
    private ?string $nombre;

    #[ORM\Column(nullable: true)]
    private ?string $apellido;

    #[ORM\ManyToOne(inversedBy: 'invitados')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservante $enlace = null;

    #[ORM\ManyToOne(inversedBy: 'invitados')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Celebracion $celebracion = null;

    #[ORM\Column(nullable: true)]
    private ?string $email;

    #[ORM\Column(nullable: true)]
    private ?bool $isEnlace;

    #[ORM\Column(nullable: true)]
    private ?bool $isPresente;

    public function __toString(): string
    {
        return $this->email.' - '.$this->apellido.', '.$this->nombre;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(?string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(?string $apellido): self
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getEnlace(): ?Reservante
    {
        return $this->enlace;
    }

    public function setEnlace(?Reservante $enlace): self
    {
        $this->enlace = $enlace;

        return $this;
    }

    public function getCelebracion(): ?Celebracion
    {
        return $this->celebracion;
    }

    public function setCelebracion(?Celebracion $celebracion): self
    {
        $this->celebracion = $celebracion;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getIsEnlace(): ?bool
    {
        return $this->isEnlace;
    }

    public function setIsEnlace(?bool $isEnlace): self
    {
        $this->isEnlace = $isEnlace;

        return $this;
    }

    public function getIsPresente(): ?bool
    {
        return $this->isPresente;
    }

    public function setIsPresente(?bool $isPresente): self
    {
        $this->isPresente = $isPresente;

        return $this;
    }
}
