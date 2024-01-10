<?php

namespace App\Entity;

use App\Entity\Traits\CssClass;
use App\Entity\Traits\LinksTrait;
use App\Entity\Traits\OfertTrait;
use App\Repository\EntradaRepository;
use App\Service\UploaderHelper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\InverseJoinColumn;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\JoinTable;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: 'App\Repository\EntradaRepository')]
class Entrada implements \Stringable
{
    use TimestampableEntity;

    use OfertTrait;

    use LinksTrait;

    use CssClass;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups('mail')]
    #[Assert\NotBlank]
    private string $titulo;

    #[ORM\Column(type: 'text', length: 8000, nullable: true)]
    #[Groups('mail')]
    private ?string $contenido = null;

    #[ORM\ManyToOne( inversedBy: 'entradas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $autor = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('mail')]
    private ?string $imageFilename = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $publicadoAt = null;

    #[ORM\OneToMany(mappedBy: 'entrada', targetEntity: EntradaReference::class)]
    #[ORM\OrderBy(['posicion' => 'ASC'])]
    private ?Collection $entradaReferences;

    #[ORM\Column(type: 'integer')]
    private ?int $likes = 0;

    #[ORM\OneToMany(mappedBy: 'entrada', targetEntity: Comentario::class, fetch: 'EXTRA_LAZY')]
    #[ORM\OrderBy(['createdAt' => 'DESC'])]
    private ?Collection $comentarios;

    #[ORM\ManyToMany(targetEntity: Principal::class, mappedBy: 'entradas')]
    private ?Collection $principals;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $eventoAt = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $typeOrigin = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $typeCarry = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $orden = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $encabezado = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $destacado = null;

    #[ORM\ManyToOne( inversedBy: 'entradas')]
    private ?ModelTemplate $modelTemplate = null;

    #[ORM\ManyToMany(targetEntity: Contacto::class, inversedBy: 'entradas')]
    private ?Collection $contacto;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isSinTitulo = null;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isPermanente = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $footer = null;

    #[ORM\ManyToMany(targetEntity: ButtonLink::class, inversedBy: 'entradas')]
    private ?Collection $button;

    #[ORM\Column(type: 'string', length: 150, nullable: true, unique: true)]
    private ?string $identificador = null;

    #[JoinTable(name: 'section_entrada')]
    #[JoinColumn(name: 'entrada_id', referencedColumnName: 'id')]
    #[InverseJoinColumn(name: 'section_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Section::class, inversedBy: 'entradas')]
    private Collection $sections;

    public function __construct()
    {
        $this->entradaReferences = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->principals = new ArrayCollection();
        $this->contacto = new ArrayCollection();
        $this->button = new ArrayCollection();
        $this->sections = new ArrayCollection();
    }

    /**
     * @return string|null
     */
    public function __toString(): string
    {
        return $this->titulo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

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

    public function getAutor(): ?User
    {
        return $this->autor;
    }

    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

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

    public function getPublicadoAt(): ?\DateTimeInterface
    {
        return $this->publicadoAt;
    }

    public function setPublicadoAt(?\DateTimeInterface $publicadoAt): self
    {
        $this->publicadoAt = $publicadoAt;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return UploaderHelper::IMAGE_ENTRADA.'/'.$this->getImageFilename();
    }

    /**
     * @return Collection|EntradaReference[]|null
     */
    public function getEntradaReferences(): ?Collection
    {
        return $this->entradaReferences;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function incrementaLikeCount(): self
    {
        $this->likes = $this->likes + 1;

        return $this;
    }

    /**
     * @return Collection|Comentario[]|null
     */
    public function getComentariosNoDeleted(): ?Collection
    {
        $criterio = EntradaRepository::createNoDeletedCriteria();

        return $this->comentarios->matching($criterio);
    }

    /**
     * @return Collection|Comentario[]|null
     */
    public function getComentarios(): ?Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setEntrada($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getEntrada() === $this) {
                $comentario->setEntrada(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Principal[]|null
     */
    public function getPrincipals(): ?Collection
    {
        return $this->principals;
    }

    public function addPrincipal(Principal $principal): self
    {
        if (!$this->principals->contains($principal)) {
            $this->principals[] = $principal;
            $principal->addEntrada($this);
        }

        return $this;
    }

    public function removePrincipal(Principal $principal): self
    {
        if ($this->principals->contains($principal)) {
            $this->principals->removeElement($principal);
            $principal->removeEntrada($this);
        }

        return $this;
    }

    public function getEventoAt(): ?\DateTimeInterface
    {
        return $this->eventoAt;
    }

    public function setEventoAt(?\DateTimeInterface $eventoAt): self
    {
        $this->eventoAt = $eventoAt;

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

    public function getTypeCarry(): ?string
    {
        return $this->typeCarry;
    }

    public function setTypeCarry(?string $typeCarry): self
    {
        $this->typeCarry = $typeCarry;

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

    public function getEncabezado(): ?bool
    {
        return $this->encabezado;
    }

    public function setEncabezado(?bool $encabezado): self
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    public function getDestacado(): ?bool
    {
        return $this->destacado;
    }

    public function setDestacado(?bool $destacado): self
    {
        $this->destacado = $destacado;

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
     * @return Collection|Contacto[]|null
     */
    public function getContacto(): ?Collection
    {
        return $this->contacto;
    }

    public function addContacto(Contacto $contacto): self
    {
        if (!$this->contacto->contains($contacto)) {
            $this->contacto[] = $contacto;
        }

        return $this;
    }

    public function removeContacto(Contacto $contacto): self
    {
        $this->contacto->removeElement($contacto);

        return $this;
    }

    public function getIsSinTitulo(): ?bool
    {
        return $this->isSinTitulo;
    }

    public function setIsSinTitulo(?bool $isSinTitulo): self
    {
        $this->isSinTitulo = $isSinTitulo;

        return $this;
    }

    public function getIsPermanente(): ?bool
    {
        return $this->isPermanente;
    }

    public function setIsPermanente(?bool $isPermanente): self
    {
        $this->isPermanente = $isPermanente;

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
     * @return Collection|ButtonLink[]|null
     */
    public function getButton(): ?Collection
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

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    public function setIdentificador(?string $identificador): self
    {
        if (null === $identificador) {
            $identificador = str_replace(' ', '-', strip_tags($this->titulo));
        }
        $this->identificador = $identificador;

        return $this;
    }

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section = null): self
    {
        if ($section) {
            if (!$this->sections->contains($section)) {
                $this->sections[] = $section;
            }
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        $this->sections->removeElement($section);

        return $this;
    }
}
