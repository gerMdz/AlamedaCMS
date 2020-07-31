<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 *     fields={"email"},
 *     message="Este email ya está registrado"
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=40)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups("perfil")
     * @Assert\NotBlank(message="Por Favor ingrese un email válido")
     * @Assert\Email(message="Por Favor ingrese un email válido")
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("perfil")
     */
    private $primerNombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("perfil")
     */
    private $twitterUsername;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("perfil")
     */
    private $avatarUrl;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ApiToken", mappedBy="user", orphanRemoval=true)
     */
    private $apiTokens;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PageIndex", mappedBy="autor")
     */
    private $pageIndices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Entrada", mappedBy="autor")
     */
    private $entradas;

    /**
     * @ORM\OneToMany(targetEntity=Principal::class, mappedBy="autor")
     */
    private $principal;

    /**
     * @ORM\OneToMany(targetEntity=Comentario::class, mappedBy="autor")
     */
    private $comentarios;

    /**
     * @ORM\OneToMany(targetEntity=Brote::class, mappedBy="autor")
     */
    private $brotes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $aceptaTerminosAt;

    public function __construct()
    {
        $this->apiTokens = new ArrayCollection();
        $this->pageIndices = new ArrayCollection();
        $this->entradas = new ArrayCollection();
        $this->principal = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->brotes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getPrimerNombre();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrimerNombre(): ?string
    {
        return $this->primerNombre;
    }

    public function setPrimerNombre(?string $primerNombre): self
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getTwitterUsername(): ?string
    {
        return $this->twitterUsername;
    }

    public function setTwitterUsername(?string $twitterUsername): self
    {
        $this->twitterUsername = $twitterUsername;

        return $this;
    }

    public function getAvatarUrl(string $size = null): ?string
    {
        $url = 'https://robohash.org/'.$this->getEmail().'?set=set2';
        if ($size) {
            $url .= sprintf('?size=%dx%d', $size, $size);
        }

        return $url;
    }

    public function setAvatarUrl(?string $avatarUrl): self
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * @return Collection|ApiToken[]
     */
    public function getApiTokens(): Collection
    {
        return $this->apiTokens;
    }

    public function addApiToken(ApiToken $apiToken): self
    {
        if (!$this->apiTokens->contains($apiToken)) {
            $this->apiTokens[] = $apiToken;
            $apiToken->setUser($this);
        }

        return $this;
    }

    public function removeApiToken(ApiToken $apiToken): self
    {
        if ($this->apiTokens->contains($apiToken)) {
            $this->apiTokens->removeElement($apiToken);
            // set the owning side to null (unless already changed)
            if ($apiToken->getUser() === $this) {
                $apiToken->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PageIndex[]
     */
    public function getPageIndices(): Collection
    {
        return $this->pageIndices;
    }

    public function addPageIndex(PageIndex $pageIndex): self
    {
        if (!$this->pageIndices->contains($pageIndex)) {
            $this->pageIndices[] = $pageIndex;
            $pageIndex->setAutor($this);
        }

        return $this;
    }

    public function removePageIndex(PageIndex $pageIndex): self
    {
        if ($this->pageIndices->contains($pageIndex)) {
            $this->pageIndices->removeElement($pageIndex);
            // set the owning side to null (unless already changed)
            if ($pageIndex->getAutor() === $this) {
                $pageIndex->setAutor(null);
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
            $entrada->setAutor($this);
        }

        return $this;
    }

    public function removeEntrada(Entrada $entrada): self
    {
        if ($this->entradas->contains($entrada)) {
            $this->entradas->removeElement($entrada);
            // set the owning side to null (unless already changed)
            if ($entrada->getAutor() === $this) {
                $entrada->setAutor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Principal[]
     */
    public function getPrincipal(): Collection
    {
        return $this->principal;
    }

    public function addPrincipals(Principal $principals): self
    {
        if (!$this->principal->contains($principals)) {
            $this->principal[] = $principals;
            $principals->setAutor($this);
        }

        return $this;
    }

    public function removePrincipals(Principal $principals): self
    {
        if ($this->principal->contains($principals)) {
            $this->principal->removeElement($principals);
            // set the owning side to null (unless already changed)
            if ($principals->getAutor() === $this) {
                $principals->setAutor(null);
            }
        }

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
            $comentario->setAutor($this);
        }

        return $this;
    }

    public function removeComentario(Comentario $comentario): self
    {
        if ($this->comentarios->contains($comentario)) {
            $this->comentarios->removeElement($comentario);
            // set the owning side to null (unless already changed)
            if ($comentario->getAutor() === $this) {
                $comentario->setAutor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Brote[]
     */
    public function getbrotes(): Collection
    {
        return $this->brotes;
    }

    public function addbrote(Brote $brote): self
    {
        if (!$this->brotes->contains($brote)) {
            $this->brotes[] = $brote;
            $brote->setAutor($this);
        }

        return $this;
    }

    public function removebrote(Brote $brote): self
    {
        if ($this->brotes->contains($brote)) {
            $this->brotes->removeElement($brote);
            // set the owning side to null (unless already changed)
            if ($brote->getAutor() === $this) {
                $brote->setAutor(null);
            }
        }

        return $this;
    }

    public function getAceptaTerminosAt(): ?\DateTimeInterface
    {
        return $this->aceptaTerminosAt;
    }


    public function aceptaTerminos()
    {
        $this->aceptaTerminosAt = new \DateTime();
    }
}
