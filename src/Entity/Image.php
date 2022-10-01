<?php

namespace App\Entity;

use App\Entity\Traits\ImageTrait;
use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    use ImageTrait;
    use TimestampableEntity;


    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $author;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     */
    private ?string $linkSite;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getLinkSite(): ?string
    {
        return $this->linkSite;
    }

    public function setLinkSite(?string $linkSite): self
    {
        $this->linkSite = $linkSite;

        return $this;
    }
}
