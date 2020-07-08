<?php

namespace App\Entity;

use App\Repository\ComentarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * @ORM\Entity(repositoryClass=ComentarioRepository::class)
 */
class Comentario
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comentarios")
     * @ORM\JoinColumn(nullable=false)
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenido;

    /**
     * @ORM\ManyToOne(targetEntity=Entrada::class, inversedBy="comentarios")
     */
    private $entrada;

    /**
     * @ORM\ManyToOne(targetEntity=Principal::class, inversedBy="comentarios")
     */
    private $principal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDeleted = false;

    /**
     * @ORM\ManyToOne(targetEntity=Derivada::class, inversedBy="comenttarios")
     */
    private $derivada;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAutor(): ?User
    {
        return $this->autor;
    }

    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

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

    public function getPrincipal(): ?Principal
    {
        return $this->principal;
    }

    public function setPrincipal(?Principal $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    public function getDerivada(): ?Derivada
    {
        return $this->derivada;
    }

    public function setDerivada(?Derivada $derivada): self
    {
        $this->derivada = $derivada;

        return $this;
    }
}
