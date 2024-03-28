<?php

namespace App\Entity;

use AllowDynamicProperties;
use App\Entity\Traits\CssClass;
use App\Entity\Traits\IdentificadorTrait;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[AllowDynamicProperties] #[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu
{
    use TimestampableEntity;
    use CssClass;
    use IdentificadorTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id;

    #[ORM\Column]
    private ?string $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $identificador = null;

    #[ORM\ManyToMany(targetEntity: ItemMenu::class, mappedBy: 'menu')]
    private ArrayCollection $itemMenus;

    public function __construct()
    {
        $this->itemMenus = new ArrayCollection();
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
     * @return Collection|ItemMenu[]
     */
    public function getItemMenus(): Collection
    {
        return $this->itemMenus;
    }

    public function addItemMenu(ItemMenu $itemMenu): self
    {
        if (!$this->itemMenus->contains($itemMenu)) {
            $this->itemMenus[] = $itemMenu;
            $itemMenu->addMenu($this);
        }

        return $this;
    }

    public function removeItemMenu(ItemMenu $itemMenu): self
    {
        if ($this->itemMenus->removeElement($itemMenu)) {
            $itemMenu->removeMenu($this);
        }

        return $this;
    }
}
