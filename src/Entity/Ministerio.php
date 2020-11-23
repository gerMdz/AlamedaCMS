<?php

namespace App\Entity;

use App\Repository\MinisterioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MinisterioRepository::class)
 */
class Ministerio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity=Principal::class, mappedBy="ministerio")
     */
    private $page;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referente;

    /**
     * @ORM\ManyToMany(targetEntity=Contacto::class, mappedBy="minsterio")
     */
    private $contactos;

    public function __construct()
    {
        $this->page = new ArrayCollection();
        $this->contactos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Principal[]
     */
    public function getPage(): Collection
    {
        return $this->page;
    }

    public function addPage(Principal $page): self
    {
        if (!$this->page->contains($page)) {
            $this->page[] = $page;
            $page->setMinisterio($this);
        }

        return $this;
    }

    public function removePage(Principal $page): self
    {
        if ($this->page->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getMinisterio() === $this) {
                $page->setMinisterio(null);
            }
        }

        return $this;
    }

    public function getReferente(): ?string
    {
        return $this->referente;
    }

    public function setReferente(string $referente): self
    {
        $this->referente = $referente;

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
            $contacto->addMinsterio($this);
        }

        return $this;
    }

    public function removeContacto(Contacto $contacto): self
    {
        if ($this->contactos->removeElement($contacto)) {
            $contacto->removeMinsterio($this);
        }

        return $this;
    }
}
