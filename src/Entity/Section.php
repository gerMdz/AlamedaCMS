<?php

namespace App\Entity;

use App\Entity\Traits\ImageTrait;
use App\Entity\Traits\OfertTrait;
use App\Repository\SectionRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SectionRepository::class)
 */
class Section
{
    use OfertTrait;
    use ImageTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cssClass;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
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
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $disponibleAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeOrigin;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeSecondary;

    /**
     * @ORM\ManyToMany(targetEntity=IndexAlameda::class, mappedBy="section")
     */
    private $indexAlamedas;



    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="sections")
     */
    private $autor;

    /**
     * @ORM\OneToMany(targetEntity=RelacionSectionEntrada::class, mappedBy="section")
     */
    private $relacionSectionEntradas;

    /**
     * @ORM\OneToMany(targetEntity=Entrada::class, mappedBy="section")
     * @ORM\OrderBy({"orden" = "ASC"})
     */
    private $entradassection;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $template;

    /**
     * @ORM\Column(type="string", length=2550, nullable=true)
     */
    private $contenido;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $orden;

    /**
     * @ORM\ManyToOne(targetEntity=Principal::class, inversedBy="section")
     */
    private $principal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=ModelTemplate::class, inversedBy="sections")
     */
    private $modelTemplate;

    /**
     * @ORM\ManyToMany(targetEntity=Entrada::class, inversedBy="sections")
     */
    private $llamada;

    public function __toString()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->indexAlamedas = new ArrayCollection();

        $this->relacionSectionEntradas = new ArrayCollection();
        $this->entradassection = new ArrayCollection();
        $this->llamada = new ArrayCollection();
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

    public function getCssClass(): ?string
    {
        return $this->cssClass;
    }

    public function setCssClass(?string $cssClass): self
    {
        $this->cssClass = $cssClass;

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

    public function getTypeOrigin(): ?string
    {
        return $this->typeOrigin;
    }

    public function setTypeOrigin(?string $typeOrigin): self
    {
        $this->typeOrigin = $typeOrigin;

        return $this;
    }

    public function getTypeSecondary(): ?string
    {
        return $this->typeSecondary;
    }

    public function setTypeSecondary(?string $typeSecondary): self
    {
        $this->typeSecondary = $typeSecondary;

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

    /**
     * @return Collection|RelacionSectionEntrada[]
     */
    public function getRelacionSectionEntradas(): Collection
    {
        return $this->relacionSectionEntradas;
    }

    public function addRelacionSectionEntrada(RelacionSectionEntrada $relacionSectionEntrada): self
    {
        if (!$this->relacionSectionEntradas->contains($relacionSectionEntrada)) {
            $this->relacionSectionEntradas[] = $relacionSectionEntrada;
            $relacionSectionEntrada->setSection($this);
        }

        return $this;
    }

    public function removeRelacionSectionEntrada(RelacionSectionEntrada $relacionSectionEntrada): self
    {
        if ($this->relacionSectionEntradas->contains($relacionSectionEntrada)) {
            $this->relacionSectionEntradas->removeElement($relacionSectionEntrada);
            // set the owning side to null (unless already changed)
            if ($relacionSectionEntrada->getSection() === $this) {
                $relacionSectionEntrada->setSection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entrada[]
     */
    public function getEntradassection(): Collection
    {
        return $this->entradassection;
    }

    public function addEntradassection(Entrada $entradassection): self
    {
        if (!$this->entradassection->contains($entradassection)) {
            $this->entradassection[] = $entradassection;
            $entradassection->setSection($this);
        }

        return $this;
    }

    public function removeEntradassection(Entrada $entradassection): self
    {
        if ($this->entradassection->contains($entradassection)) {
            $this->entradassection->removeElement($entradassection);
            // set the owning side to null (unless already changed)
            if ($entradassection->getSection() === $this) {
                $entradassection->setSection(null);
            }
        }

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
    public function getLlamada(): Collection
    {
        return $this->llamada;
    }

    public function addLlamadum(Entrada $llamada): self
    {
        if (!$this->llamada->contains($llamada)) {
            $this->llamada[] = $llamada;
            $llamada->addSection($this);
        }

        return $this;
    }

    public function removeLlamadum(Entrada $llamada): self
    {
        $this->llamada->removeElement($llamada);

        return $this;
    }





//    public function removeIndexAlameda(IndexAlameda $indexAlameda): self
//    {
//        if ($this->indexAlamedas->contains($indexAlameda)) {
//            $this->indexAlamedas->removeElement($indexAlameda);
//            $indexAlameda->removeSection($this);
//        }
//
//        return $this;
//    }
}
