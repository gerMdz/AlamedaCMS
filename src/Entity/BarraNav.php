<?php

namespace App\Entity;

use App\Entity\Traits\CssClass;
use App\Repository\BarraNavRepository;
use App\Service\UploaderHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: BarraNavRepository::class)]
class BarraNav
{
    use TimestampableEntity;

    use CssClass;

    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 100)]
    private $identifier;

    #[ORM\Column(type: 'text')]
    private $content;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private $author;

    #[ORM\Column(type: 'string', length: 510, nullable: true)]
    private $imageFilename;

    #[ORM\ManyToOne(targetEntity: ModelTemplate::class, inversedBy: 'barraNavs')]
    private $modelTemplate;

    #[ORM\Column(type: 'string', length: 255)]
    private $description;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isIndex;

    #[ORM\OneToMany(targetEntity: Principal::class, mappedBy: 'navbar')]
    private $principals;

    public function __construct()
    {
        $this->principals = new ArrayCollection();
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

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): self
    {
        $this->identifier = $identifier;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function getModelTemplate(): ?ModelTemplate
    {
        return $this->modelTemplate;
    }

    public function setModelTemplate(?ModelTemplate $modelTemplate): self
    {
        $this->modelTemplate = $modelTemplate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isIsIndex(): ?bool
    {
        return $this->isIndex;
    }

    public function setIsIndex(?bool $isIndex): self
    {
        $this->isIndex = $isIndex;

        return $this;
    }

    /**
     * @return Collection<int, Principal>
     */
    public function getPrincipals(): Collection
    {
        return $this->principals;
    }

    public function addPrincipal(Principal $principal): self
    {
        if (!$this->principals->contains($principal)) {
            $this->principals[] = $principal;
            $principal->setNavbar($this);
        }

        return $this;
    }

    public function removePrincipal(Principal $principal): self
    {
        if ($this->principals->removeElement($principal)) {
            // set the owning side to null (unless already changed)
            if ($principal->getNavbar() === $this) {
                $principal->setNavbar(null);
            }
        }

        return $this;
    }

    public function getImagePath(): ?string
    {
        return UploaderHelper::IMAGE_ENTRADA.'/'.$this->getImageFilename();
    }
}
