<?php

namespace App\Entity;

use App\Entity\Traits\CssClass;
use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\LinksTrait;
use App\Entity\Traits\OfertTrait;
use App\Repository\SectionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
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
    private $name;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Groups("main")
     */
    private $identificador;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $disponible;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $columns;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups("main")
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $disponibleAt;

    /**
     * @ORM\ManyToMany(targetEntity=IndexAlameda::class, mappedBy="section")
     */
    private $indexAlamedas;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sections")
     */
    private $autor;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $template;

    /**
     * @ORM\Column(type="string", length=5100, nullable=true)
     */
    private $contenido;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("main")
     */
    private $orden;

    /**
     * @ORM\ManyToOne(targetEntity=Principal::class, inversedBy="section")
     */
    private $principal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("main")
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=ModelTemplate::class, inversedBy="sections")
     * @Groups("main")
     */
    private $modelTemplate;

    /**
     * @ORM\ManyToMany(targetEntity=Entrada::class, inversedBy="sections")
     * @ORM\OrderBy({"orden"="ASC"})
     */
    private $entrada;

    /**
     * @ORM\ManyToMany(targetEntity=Principal::class, mappedBy="secciones")
     */
    private $principales;

    /**
     * @ORM\ManyToMany(targetEntity=ButtonLink::class, inversedBy="sections")
     */
    private $button;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->indexAlamedas = new ArrayCollection();
        $this->entrada = new ArrayCollection();
        $this->principales = new ArrayCollection();
        $this->button = new ArrayCollection();
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
     * @return Collection|Entrada[]
     */
    public function getEntrada(): Collection
    {
        return $this->entrada;
    }

    public function addEntrada(Entrada $entrada): self
    {
        if (!$this->entrada->contains($entrada)) {
            $this->entrada[] = $entrada;
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        $this->entrada->removeElement($entrada);

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
}
