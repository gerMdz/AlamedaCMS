<?php

namespace App\Entity;

use App\Repository\SectionImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=SectionImageRepository::class)
 */
class SectionImage
{
    use TimestampableEntity;
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", length=36)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private UuidInterface $id;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="sectionImages")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Section $sectionId;

    /**
     * @ORM\ManyToOne(targetEntity=Image::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Image $imageId;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $nOrder;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isPrincipal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $isUsable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $filter;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    public function getSectionId(): ?Section
    {
        return $this->sectionId;
    }

    public function setSectionId(?Section $sectionId): self
    {
        $this->sectionId = $sectionId;

        return $this;
    }

    public function getImageId(): ?Image
    {
        return $this->imageId;
    }

    public function setImageId(?Image $imageId): self
    {
        $this->imageId = $imageId;

        return $this;
    }

    public function getNOrder(): ?int
    {
        return $this->nOrder;
    }

    public function setNOrder(?int $nOrder): self
    {
        $this->nOrder = $nOrder;

        return $this;
    }

    public function isIsPrincipal(): ?bool
    {
        return $this->isPrincipal;
    }

    public function setIsPrincipal(?bool $isPrincipal): self
    {
        $this->isPrincipal = $isPrincipal;

        return $this;
    }

    public function isIsUsable(): ?bool
    {
        return $this->isUsable;
    }

    public function setIsUsable(?bool $isUsable): self
    {
        $this->isUsable = $isUsable;

        return $this;
    }

    public function getFilter(): ?string
    {
        return $this->filter;
    }

    public function setFilter(?string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }


}
