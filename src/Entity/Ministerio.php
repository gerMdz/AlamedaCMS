<?php

namespace App\Entity;

use App\Repository\MinisterioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MinisterioRepository::class)]
class Ministerio implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $nombre;

    #[ORM\OneToMany(mappedBy: 'ministerio', targetEntity: Principal::class)]
    private Collection $page;

    #[ORM\Column]
    private ?string $referente;

    #[ORM\ManyToMany(targetEntity: Contacto::class, mappedBy: 'ministerio')]
    private Collection $contactos;

    public function __construct()
    {
        $this->page = new ArrayCollection();
        $this->contactos = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->nombre;
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
            $contacto->addMinisterio($this);
        }

        return $this;
    }

    public function removeContacto(Contacto $contacto): self
    {
        if ($this->contactos->removeElement($contacto)) {
            $contacto->removeMinisterio($this);
        }

        return $this;
    }
}
