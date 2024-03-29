<?php

namespace App\Entity;

use App\Repository\RolesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RolesRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Roles implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?string $identificador = null;

    #[ORM\Column]
    private ?string $descripcion = null;

    #[ORM\Column(type: 'boolean')]
    private bool $isActivo;

    #[ORM\ManyToMany(targetEntity: ItemMenu::class, mappedBy: 'role')]
    private ArrayCollection $itemMenus;

    public function __construct()
    {
        $this->itemMenus = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->getIdentificador();
    }

    //    public function __construct()
    //    {
    //        $nombre = $this->nombre;
    //        $this->identificador = 'ROLE_'.$this->nombre;
    //    }

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

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    //    public function setIdentificador(string $nombre): self
    //    {
    //
    // //        $this->identificador = $identificador;
    //        $this->identificador = 'ROLE_'.$this->getNombre();
    //
    //        return $this;
    //    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setIdentificador(): void
    {
        $this->identificador = 'ROLE_'.$this->nombre;
    }

    public function getIsActivo(): ?bool
    {
        return $this->isActivo;
    }

    public function setIsActivo(bool $isActivo): self
    {
        $this->isActivo = $isActivo;

        return $this;
    }

    public function getItemMenus(): Collection
    {
        return $this->itemMenus;
    }

    public function addItemMenu(ItemMenu $itemMenu): self
    {
        if (!$this->itemMenus->contains($itemMenu)) {
            $this->itemMenus[] = $itemMenu;
            $itemMenu->addRole($this);
        }

        return $this;
    }

    public function removeItemMenu(ItemMenu $itemMenu): self
    {
        if ($this->itemMenus->removeElement($itemMenu)) {
            $itemMenu->removeRole($this);
        }

        return $this;
    }
}
