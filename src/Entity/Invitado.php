<?php

namespace App\Entity;

use App\Repository\InvitadoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InvitadoRepository::class)
 */
class Invitado
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $apellido;

    /**
     * @ORM\ManyToOne(targetEntity=Reservante::class, inversedBy="invitados")
     * @ORM\JoinColumn(nullable=false)
     */
    private $enlace;

    /**
     * @ORM\ManyToOne(targetEntity=Celebracion::class, inversedBy="invitados")
     * @ORM\JoinColumn(nullable=false)
     */
    private $celebracion;

    public function getId(): ?int
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
}
