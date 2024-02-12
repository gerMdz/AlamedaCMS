<?php

namespace App\Entity;

use App\Repository\ChannelFeedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChannelFeedRepository::class)]
class ChannelFeed implements \Stringable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $autor;

    #[ORM\Column(type: 'string', length: 255)]
    private $owner;

    #[ORM\Column(type: 'string', length: 255)]
    private $descripcion;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $link;

    #[ORM\OneToMany(targetEntity: ItemFeed::class, mappedBy: 'channelFeed')]
    private Collection $item;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return Collection|ItemFeed[]
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(ItemFeed $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item[] = $item;
            $item->setChannelFeed($this);
        }

        return $this;
    }

    public function removeItem(ItemFeed $item): self
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getChannelFeed() === $this) {
                $item->setChannelFeed(null);
            }
        }

        return $this;
    }
}
