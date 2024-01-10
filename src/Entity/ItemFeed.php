<?php

namespace App\Entity;

use App\Repository\ItemFeedRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemFeedRepository::class)]
class ItemFeed
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $descripcion;

    #[ORM\Column(type: 'datetime')]
    private $pubDateAt;

    #[ORM\Column(type: 'string', length: 510)]
    private $linkUrl;

    #[ORM\Column(type: 'string', length: 255)]
    private $linkType;

    #[ORM\Column(type: 'string', length: 255)]
    private $linkLength;

    #[ORM\Column(type: 'integer')]
    private $linkLongitud;

    #[ORM\Column(type: 'time')]
    private $duracion;

    #[ORM\Column(type: 'string', length: 255)]
    private $guid;

    #[ORM\ManyToOne( inversedBy: 'item')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ChannelFeed $channelFeed = null;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getPubDateAt(): ?\DateTimeInterface
    {
        return $this->pubDateAt;
    }

    public function setPubDateAt(\DateTimeInterface $pubDateAt): self
    {
        $this->pubDateAt = $pubDateAt;

        return $this;
    }

    public function getLinkUrl(): ?string
    {
        return $this->linkUrl;
    }

    public function setLinkUrl(string $linkUrl): self
    {
        $this->linkUrl = $linkUrl;

        return $this;
    }

    public function getLinkType(): ?string
    {
        return $this->linkType;
    }

    public function setLinkType(string $linkType): self
    {
        $this->linkType = $linkType;

        return $this;
    }

    public function getLinkLength(): ?string
    {
        return $this->linkLength;
    }

    public function setLinkLength(string $linkLength): self
    {
        $this->linkLength = $linkLength;

        return $this;
    }

    public function getLinkLongitud(): ?int
    {
        return $this->linkLongitud;
    }

    public function setLinkLongitud(int $linkLongitud): self
    {
        $this->linkLongitud = $linkLongitud;

        return $this;
    }

    public function getDuracion(): ?\DateTimeInterface
    {
        return $this->duracion;
    }

    public function setDuracion(\DateTimeInterface $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function setGuid(string $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    public function getChannelFeed(): ?ChannelFeed
    {
        return $this->channelFeed;
    }

    public function setChannelFeed(?ChannelFeed $channelFeed): self
    {
        $this->channelFeed = $channelFeed;

        return $this;
    }
}
