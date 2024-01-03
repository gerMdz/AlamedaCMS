<?php

namespace App\Entity;

use App\Entity\Traits\CssClass;
use App\Entity\Traits\IdentificadorTrait;
use App\Entity\Traits\ImageTrait;
use App\Repository\BlocsFixesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass=BlocsFixesRepository::class)
 */
class BlocsFixes
{
    use CssClass;
    use ImageTrait;
    use TimestampableEntity;
    use IdentificadorTrait;
    /**
     * @ORM\Id()
     *
     * @ORM\Column(type="uuid", length=36)
     *
     * @ORM\GeneratedValue(strategy="CUSTOM")
     *
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private UuidInterface $id;

    /**
     * @ORM\ManyToMany(targetEntity=Principal::class, inversedBy="blocsFixes")
     */
    private Collection $page;

    /**
     * @ORM\ManyToMany(targetEntity=Section::class)
     */
    private Collection $section;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $description = null;

    /**
     * @ORM\ManyToOne(targetEntity=TypeFixe::class)
     */
    private ?TypeFixe $fixes_type = null;

    /**
     * @ORM\ManyToOne(targetEntity=IndexAlameda::class, inversedBy="blocs_fixes")
     *
     * @ORM\JoinTable(name="blocs_fixes_index_alameda")
     */
    private ?IndexAlameda $indexAlameda = null;

    public function __construct()
    {
        $this->id = Uuid::uuid4();
        $this->page = new ArrayCollection();
        $this->section = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->description;
    }

    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Principal>
     */
    public function getPage(): Collection
    {
        return $this->page;
    }

    public function addPage(Principal $page): self
    {
        if (!$this->page->contains($page)) {
            $this->page[] = $page;
        }

        return $this;
    }

    public function removePage(Principal $page): self
    {
        $this->page->removeElement($page);

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(Section $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        $this->section->removeElement($section);

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getFixesType(): ?TypeFixe
    {
        return $this->fixes_type;
    }

    public function setFixesType(?TypeFixe $fixes_type): self
    {
        $this->fixes_type = $fixes_type;

        return $this;
    }

    public function getIndexAlameda(): ?IndexAlameda
    {
        return $this->indexAlameda;
    }

    public function setIndexAlameda(?IndexAlameda $indexAlameda): self
    {
        $this->indexAlameda = $indexAlameda;

        return $this;
    }
}
