<?php

namespace App\Entity;

use App\Entity\Traits\CssClass;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\LinksTrait;
use App\Entity\Traits\OfertTrait;
use App\Repository\SectionRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
{
    use OfertTrait;
    use ImageTrait;
    use LinksTrait;
    use CssClass;
    use TimestampableEntity;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Groups("main")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("main")
     */
    private ?string $name;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("main")
     */
    private ?string $identificador;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private ?bool $disponible;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private ?int $columns;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("main")
     */
    private ?string $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private ?DateTimeInterface $disponibleAt;

    /**
     * @ORM\ManyToMany(targetEntity=IndexAlameda::class, mappedBy="section")
     */
    private Collection $indexAlamedas;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sections")
     */
    private ?User $autor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $template;

    /**
     * @ORM\Column(type="text", length=8000, nullable=true)
     * @Groups("mail")
     */
    private ?string $contenido;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("main")
     */
    private ?int $orden;

    /**
     * @ORM\ManyToOne(targetEntity=Principal::class, inversedBy="section")
     * @Groups("mail")
     */
    private ?Principal $principal;

    /**
     * @ORM\Column(type="string", length=510, nullable=true)
     * @Groups({"main", "mail"})
     */
    private ?string $title;

    /**
     * @ORM\ManyToOne(targetEntity=ModelTemplate::class, inversedBy="sections")
     * @Groups("main")
     */
    private ?ModelTemplate $modelTemplate;

    /**
     * @ORM\ManyToMany(targetEntity=Principal::class, mappedBy="secciones")
     * @Groups("mail")
     */
    private Collection $principales;

    /**
     * @ORM\ManyToMany(targetEntity=ButtonLink::class, inversedBy="sections")
     */
    private Collection $button;

    /**
     * @ORM\ManyToMany(targetEntity=Entrada::class, mappedBy="sections")
     */
    private Collection $entradas;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $footer;

    /**
     * @ORM\OneToMany(targetEntity=SectionImage::class, mappedBy="sectionId")
     */
    private $sectionImages;



    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->indexAlamedas = new ArrayCollection();
        $this->principales = new ArrayCollection();
        $this->button = new ArrayCollection();
        $this->createdAt = new DateTime();
        $this->markAsUpdated();
        $this->entradas = new ArrayCollection();
        $this->sectionImages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    public function setIdentificador(?string $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }

    public function getDisponible(): ?bool
    {
        return $this->disponible;
    }

    public function setDisponible(?bool $disponible): self
    {
        $this->disponible = $disponible;

        return $this;
    }

    public function getColumns(): ?int
    {
        return $this->columns;
    }

    public function setColumns(?int $columns): self
    {
        $this->columns = $columns;

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

    public function getDisponibleAt(): ?DateTimeInterface
    {
        return $this->disponibleAt;
    }

    public function setDisponibleAt(?DateTimeInterface $disponibleAt): self
    {
        $this->disponibleAt = $disponibleAt;

        return $this;
    }






    /**
     * @return Collection|IndexAlameda[]
     */
    public function getIndexAlamedas(): Collection
    {
        return $this->indexAlamedas;
    }

    public function addIndexAlameda(IndexAlameda $indexAlameda): self
    {
        if (!$this->indexAlamedas->contains($indexAlameda)) {
            $this->indexAlamedas[] = $indexAlameda;
            $indexAlameda->addSection($this);
        }

        return $this;
    }

    public function removeIndexAlameda(IndexAlameda $indexAlameda): self
    {
        if ($this->indexAlamedas->contains($indexAlameda)) {
            $this->indexAlamedas->removeElement($indexAlameda);
            $indexAlameda->removeSection($this);
        }

        return $this;
    }



    public function getAutor(): ?User
    {
        return $this->autor;
    }

    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

        return $this;
    }



    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): self
    {
        $this->template = $template;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(?string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function getOrden(): ?int
    {
        return $this->orden;
    }

    public function setOrden(?int $orden): self
    {
        $this->orden = $orden;

        return $this;
    }

    public function getPrincipal(): ?Principal
    {
        return $this->principal;
    }

    public function setPrincipal(?Principal $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    /**
     * @return Collection|Principal[]
     */
    public function getPrincipales(): Collection
    {
        return $this->principales;
    }

    public function addPrincipale(Principal $principale): self
    {
        if (!$this->principales->contains($principale)) {
            $this->principales[] = $principale;
            $principale->addSeccione($this);
        }

        return $this;
    }

    public function removePrincipale(Principal $principale): self
    {
        if ($this->principales->removeElement($principale)) {
            $principale->removeSeccione($this);
        }

        return $this;
    }

    /**
     * @return Collection|ButtonLink[]
     */
    public function getButton(): Collection
    {
        return $this->button;
    }

    public function addButton(ButtonLink $button): self
    {
        if (!$this->button->contains($button)) {
            $this->button[] = $button;
        }

        return $this;
    }

    public function removeButton(ButtonLink $button): self
    {
        $this->button->removeElement($button);

        return $this;
    }

    public function markAsUpdated()
    {
        $this->updatedAt = new DateTime();
    }

    /**
     * @return Collection<int, Entrada>
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entrada $entrada): self
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas[] = $entrada;
            $entrada->addSection($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->removeElement($entrada)) {
            $entrada->removeSection($this);
        }

        return $this;
    }

    public function getFooter(): ?string
    {
        return $this->footer;
    }

    public function setFooter(?string $footer): self
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * @return Collection<int, SectionImage>
     */
    public function getSectionImages(): Collection
    {
        return $this->sectionImages;
    }

    public function addSectionImage(SectionImage $sectionImage): self
    {
        if (!$this->sectionImages->contains($sectionImage)) {
            $this->sectionImages[] = $sectionImage;
            $sectionImage->setSectionId($this);
        }

        return $this;
    }

    public function removeSectionImage(SectionImage $sectionImage): self
    {
        if ($this->sectionImages->removeElement($sectionImage)) {
            // set the owning side to null (unless already changed)
            if ($sectionImage->getSectionId() === $this) {
                $sectionImage->setSectionId(null);
            }
        }

        return $this;
    }

}
