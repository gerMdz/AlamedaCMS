<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: 'App\Repository\InvitadoRepository')]
class Invitado implements \Stringable
{
    use TimestampableEntity;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'Ramsey\Uuid\Doctrine\UuidGenerator')]
    private $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('export_invitado')]
    private $telefono;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $dni;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $apellido;

    #[ORM\ManyToOne(targetEntity: Reservante::class, inversedBy: 'invitados')]
    #[ORM\JoinColumn(nullable: false)]
    private $enlace;

    #[ORM\ManyToOne(targetEntity: Celebracion::class, inversedBy: 'invitados')]
    #[ORM\JoinColumn(nullable: false)]
    private $celebracion;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $email;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isEnlace;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isPresente;

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
