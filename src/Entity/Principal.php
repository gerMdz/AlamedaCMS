<?php

namespace App\Entity;

use App\Entity\Traits\CssClass;
use App\Entity\Traits\ImageTrait;
use App\Repository\PrincipalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PrincipalRepository::class)]
class Principal implements \Stringable
{
    use TimestampableEntity;

    use ImageTrait;

    use CssClass;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'principal')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $autor = null;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'El título de la página, no debe estar en blanco')]
    #[Groups('mail')]
    private ?string $titulo = null;

    #[ORM\Column(type: 'string', length: 2550)]
    #[Groups('mail')]
    private ?string $contenido = null;

    #[ORM\Column(type: 'string', length: 150, unique: true, nullable: true)]
    #[Groups('mail')]
    private ?string $linkRoute = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $likes = null;

    #[ORM\OneToMany(targetEntity: Comentario::class, mappedBy: 'principal')]
    private Collection $comentarios;

    #[ORM\ManyToMany(targetEntity: Entrada::class, inversedBy: 'principals')]
    private $entradas;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private ?bool $isActive = null;

    #[ORM\OneToMany(targetEntity: Section::class, mappedBy: 'principal')]
    private Collection $section;

    #[ORM\ManyToOne(inversedBy: 'brote')]
    private ?Principal $principal = null;

    #[ORM\OneToMany(targetEntity: Principal::class, mappedBy: 'principal')]
    private Collection $brote;

    #[ORM\ManyToOne(inversedBy: 'principals')]
    private ?ModelTemplate $modelTemplate = null;

    #[ORM\ManyToOne(inversedBy: 'page')]
    private ?Ministerio $ministerio = null;

    #[ORM\ManyToMany(targetEntity: Section::class, inversedBy: 'principales')]
    #[ORM\OrderBy(['orden' => 'ASC'])]
    private $secciones;

    #[ORM\ManyToMany(targetEntity: ButtonLink::class, inversedBy: 'principals')]
    private $button;

    #[ORM\OneToMany(targetEntity: ItemMenu::class, mappedBy: 'pathInterno')]
    private Collection $itemMenus;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups('mail')]
    private ?bool $isLinkExterno = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('mail')]
    private ?string $linkPosting = null;

    #[ORM\ManyToMany(targetEntity: BlocsFixes::class, mappedBy: 'page')]
    private Collection $blocsFixes;

    #[ORM\ManyToOne(targetEntity: BarraNav::class, inversedBy: 'principals')]
    private $navbar;

    public function __construct()
    {
        $this->comentarios = new ArrayCollection();
        $this->entradas = new ArrayCollection();
        $this->section = new ArrayCollection();
        $this->brote = new ArrayCollection();
        $this->button = new ArrayCollection();
        $this->itemMenus = new ArrayCollection();
        $this->blocsFixes = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->titulo;
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function getLinkRoute(): ?string
    {
        return $this->linkRoute;
    }

    public function setLinkRoute(?string $linkRoute): self
    {
        null == $linkRoute ? $linkRoute = strtolower(
            str_replace(' ', '-', trim($this->titulo.'-'.$this->id))
        ) : $linkRoute;
        $this->linkRoute = strip_tags(strtolower(str_replace(' ', '-', trim($linkRoute))));

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(?int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * @return Collection|Comentario[]
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setPrincipal($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getPrincipal() === $this) {
                $comentario->setPrincipal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entrada[]
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    public function addEntrada(Entrada $entrada): self
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas[] = $entrada;
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->contains($entrada)) {
            $this->entradas->removeElement($entrada);
        }

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSection(): Collection
    {
        return $this->section;
    }

    public function addSection(Section $section): self
    {
        if (!$this->section->contains($section)) {
            $this->section[] = $section;
            $section->setPrincipal($this);
        }

        return $this;
    }

    public function removeSection(Section $section): self
    {
        if ($this->section->contains($section)) {
            $this->section->removeElement($section);
            // set the owning side to null (unless already changed)
            if ($section->getPrincipal() === $this) {
                $section->setPrincipal(null);
            }
        }

        return $this;
    }

    public function getPrincipal(): ?self
    {
        return $this->principal;
    }

    public function setPrincipal(?self $principal): self
    {
        $this->principal = $principal;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getBrote(): Collection
    {
        return $this->brote;
    }

    public function addBrote(self $brote): self
    {
        if (!$this->brote->contains($brote)) {
            $this->brote[] = $brote;
            $brote->setPrincipal($this);
        }

        return $this;
    }

    public function removeBrote(self $brote): self
    {
        if ($this->brote->contains($brote)) {
            $this->brote->removeElement($brote);
            // set the owning side to null (unless already changed)
            if ($brote->getPrincipal() === $this) {
                $brote->setPrincipal(null);
            }
        }

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

    public function getMinisterio(): ?Ministerio
    {
        return $this->ministerio;
    }

    public function setMinisterio(?Ministerio $ministerio): self
    {
        $this->ministerio = $ministerio;

        return $this;
    }

    /**
     * @return Collection|Section[]
     */
    public function getSecciones(): Collection
    {
        return $this->secciones;
    }

    public function addSeccione(Section $seccione): self
    {
        if (!$this->secciones->contains($seccione)) {
            $this->secciones[] = $seccione;
        }

        return $this;
    }

    public function removeSeccione(Section $seccione): self
    {
        $this->secciones->removeElement($seccione);

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

    /**
     * @return Collection|ItemMenu[]
     */
    public function getItemMenus(): Collection
    {
        return $this->itemMenus;
    }

    public function addItemMenu(ItemMenu $itemMenu): self
    {
        if (!$this->itemMenus->contains($itemMenu)) {
            $this->itemMenus[] = $itemMenu;
            $itemMenu->setPathInterno($this);
        }

        return $this;
    }

    public function removeItemMenu(ItemMenu $itemMenu): self
    {
        if ($this->itemMenus->removeElement($itemMenu)) {
            // set the owning side to null (unless already changed)
            if ($itemMenu->getPathInterno() === $this) {
                $itemMenu->setPathInterno(null);
            }
        }

        return $this;
    }

    public function getIsLinkExterno(): ?bool
    {
        return $this->isLinkExterno;
    }

    public function setIsLinkExterno(?bool $isLinkExterno): self
    {
        $this->isLinkExterno = $isLinkExterno;

        return $this;
    }

    public function getLinkPosting(): ?string
    {
        return $this->linkPosting;
    }

    public function setLinkPosting(?string $linkPosting): self
    {
        $this->linkPosting = $linkPosting;

        return $this;
    }

    /**
     * @return Collection<int, BlocsFixes>
     */
    public function getBlocsFixes(): Collection
    {
        return $this->blocsFixes;
    }

    public function addBlocsFix(BlocsFixes $blocsFix): self
    {
        if (!$this->blocsFixes->contains($blocsFix)) {
            $this->blocsFixes[] = $blocsFix;
            $blocsFix->addPage($this);
        }

        return $this;
    }

    public function removeBlocsFix(BlocsFixes $blocsFix): self
    {
        if ($this->blocsFixes->removeElement($blocsFix)) {
            $blocsFix->removePage($this);
        }

        return $this;
    }

    public function getNavbar(): ?BarraNav
    {
        return $this->navbar;
    }

    public function setNavbar(?BarraNav $navbar): self
    {
        $this->navbar = $navbar;

        return $this;
    }
}
