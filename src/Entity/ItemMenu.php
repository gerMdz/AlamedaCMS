<?php

namespace App\Entity;


use AllowDynamicProperties;
use App\Entity\Traits\CssClass;
use App\Entity\Traits\IdentificadorTrait;
use App\Repository\ItemMenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[AllowDynamicProperties] #[ORM\Entity(repositoryClass: ItemMenuRepository::class)]
class ItemMenu
{
    use TimestampableEntity;

    use CssClass;

    use IdentificadorTrait;

    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 36)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private ?string $id;

    #[ORM\ManyToMany(targetEntity: Roles::class, inversedBy: 'itemMenus')]
    private ArrayCollection $role;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $label;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $badge;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $icon;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isExterno;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isActivo;

    #[ORM\ManyToOne(inversedBy: 'itemMenus')]
    private ?ItemMenu $parent = null;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: ItemMenu::class)]
    private Collection $itemMenus;

    #[ORM\ManyToOne(inversedBy: 'itemMenus')]
    private ?Principal $pathInterno = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $pathLibre;

    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'itemMenus')]
    private ArrayCollection $menu;

    public function __construct()
    {
        $this->role = new ArrayCollection();
        $this->itemMenus = new ArrayCollection();
        $this->menu = new ArrayCollection();

    }

    public function __toString()
    {
        return $this->label;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return Collection
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Roles $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
        }

        return $this;
    }

    public function removeRole(Roles $role): self
    {
        $this->role->removeElement($role);

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getBadge(): ?string
    {
        return $this->badge;
    }

    public function setBadge(?string $badge): self
    {
        $this->badge = $badge;

        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIsExterno(): ?bool
    {
        return $this->isExterno;
    }

    public function setIsExterno(?bool $isExterno): self
    {
        $this->isExterno = $isExterno;

        return $this;
    }

    public function getIsActivo(): ?bool
    {
        return $this->isActivo;
    }

    public function setIsActivo(?bool $isActivo): self
    {
        $this->isActivo = $isActivo;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getItemMenus(): Collection
    {
        return $this->itemMenus;
    }

    public function addItemMenu(self $itemMenu): self
    {
        if (!$this->itemMenus->contains($itemMenu)) {
            $this->itemMenus[] = $itemMenu;
            $itemMenu->setParent($this);
        }

        return $this;
    }

    public function removeItemMenu(self $itemMenu): self
    {
        if ($this->itemMenus->removeElement($itemMenu)) {
            // set the owning side to null (unless already changed)
            if ($itemMenu->getParent() === $this) {
                $itemMenu->setParent(null);
            }
        }

        return $this;
    }

    public function getPathInterno(): ?Principal
    {
        return $this->pathInterno;
    }

    public function getLinkRoute(): ?string
    {
        return $this->pathInterno->getLinkRoute();
    }

    public function setPathInterno(?Principal $pathInterno): self
    {
        $this->pathInterno = $pathInterno;

        return $this;
    }

    public function getPathLibre(): ?string
    {
        return $this->pathLibre;
    }

    public function setPathLibre(?string $pathLibre): self
    {
        $this->pathLibre = $pathLibre;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menu->removeElement($menu);

        return $this;
    }

    public function getOrderitem(): ?int
    {
        return $this->orderitem;
    }

    public function setOrderitem(?int $orderitem): self
    {
        $this->orderitem = $orderitem;

        return $this;
    }

    /**
     * @return array
     */
    public function getRol(): array
    {
        return $this->rol;
    }

    public function addRol(Roles $rol): self
    {
        if (!$this->rol->contains($rol)) {
            $this->rol[] = $rol;
        }

        return $this;
    }

    public function removeRol(Roles $rol): self
    {
        $this->rol->removeElement($rol);

        return $this;
    }
}
