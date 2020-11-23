<?php

namespace App\Entity;

use App\Repository\TipoContactoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipoContactoRepository::class)
 */
class TipoContacto
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $tipo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referencia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $icon;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private $textoReferencia;

    /**
     * @ORM\OneToMany(targetEntity=Contacto::class, mappedBy="tipo")
     */
    private $contactos;

    public function __construct()
    {
        $this->contactos = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->tipo;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getReferencia(): ?string
    {
        return $this->referencia;
    }

    public function setReferencia(string $referencia): self
    {
        $this->referencia = $referencia;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getTextoReferencia(): ?string
    {
        return $this->textoReferencia;
    }

    public function setTextoReferencia(?string $textoReferencia): self
    {
        $this->textoReferencia = $textoReferencia;

        return $this;
    }

    /**
     * @return Collection|Contacto[]
     */
    public function getContactos(): Collection
    {
        return $this->contactos;
    }

    public function addContacto(Contacto $contacto): self
    {
        if (!$this->contactos->contains($contacto)) {
            $this->contactos[] = $contacto;
            $contacto->setTipo($this);
        }

        return $this;
    }

    public function removeContacto(Contacto $contacto): self
    {
        if ($this->contactos->removeElement($contacto)) {
            // set the owning side to null (unless already changed)
            if ($contacto->getTipo() === $this) {
                $contacto->setTipo(null);
            }
        }

        return $this;
    }


}
