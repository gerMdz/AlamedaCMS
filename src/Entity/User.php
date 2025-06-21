<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entidad que representa a un usuario del sistema.
 * 
 * Esta clase implementa las interfaces necesarias para la autenticación y seguridad
 * en Symfony, y gestiona toda la información relacionada con los usuarios,
 * incluyendo sus relaciones con otras entidades del sistema.
 */
#[ORM\Entity(repositoryClass: \App\Repository\UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Este email ya está registrado')]
class User implements UserInterface, PasswordAuthenticatedUserInterface, \Stringable
{
    /**
     * Identificador único del usuario.
     * 
     * Se utiliza UUID como identificador para mayor seguridad.
     */
    #[ORM\Id]
    #[ORM\Column(type: 'string', length: 40)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: \Ramsey\Uuid\Doctrine\UuidGenerator::class)]
    private $id;

    /**
     * Dirección de correo electrónico del usuario.
     * 
     * Se utiliza como identificador único para la autenticación.
     */
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups('perfil')]
    #[Assert\NotBlank(message: 'Por Favor ingrese un email válido')]
    #[Assert\Email(message: 'Por Favor ingrese un email válido')]
    private $email;

    /**
     * Roles asignados al usuario.
     * 
     * Determina los permisos y accesos del usuario en el sistema.
     */
    #[ORM\Column(type: 'json')]
    private $roles = [];

    /**
     * Primer nombre del usuario.
     * 
     * Utilizado para identificación personal y visualización en la interfaz.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('perfil')]
    private $primerNombre;

    /**
     * Contraseña cifrada del usuario.
     * 
     * Almacena la contraseña del usuario en formato cifrado por seguridad.
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $password = null;

    /**
     * Nombre de usuario en Twitter.
     * 
     * Opcional, utilizado para integración con redes sociales.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('perfil')]
    private $twitterUsername;

    /**
     * URL del avatar del usuario.
     * 
     * Imagen de perfil del usuario, si no se proporciona se genera automáticamente.
     */
    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('perfil')]
    private $avatarUrl;

    /**
     * Tokens de API asociados al usuario.
     * 
     * Utilizados para autenticación en la API del sistema.
     */
    #[ORM\OneToMany(mappedBy: 'user', targetEntity: ApiToken::class, orphanRemoval: true)]
    private Collection $apiTokens;

    /**
     * Páginas de índice creadas por el usuario.
     * 
     * Relación con las páginas de índice donde el usuario es autor.
     */
    #[ORM\OneToMany(mappedBy: 'autor', targetEntity: PageIndex::class)]
    private Collection $pageIndices;

    /**
     * Entradas creadas por el usuario.
     * 
     * Relación con las entradas de contenido donde el usuario es autor.
     */
    #[ORM\OneToMany(mappedBy: 'autor', targetEntity: Entrada::class)]
    private Collection $entradas;

    /**
     * Elementos principales creados por el usuario.
     * 
     * Relación con los elementos principales donde el usuario es autor.
     */
    #[ORM\OneToMany(mappedBy: 'autor', targetEntity: Principal::class)]
    private Collection $principal;

    /**
     * Comentarios realizados por el usuario.
     * 
     * Relación con los comentarios donde el usuario es autor.
     */
    #[ORM\OneToMany(mappedBy: 'autor', targetEntity: Comentario::class)]
    private Collection $comentarios;

    /**
     * Fecha y hora en que el usuario aceptó los términos y condiciones.
     * 
     * Registro temporal para cumplimiento legal.
     */
    #[ORM\Column(type: 'datetime')]
    private $aceptaTerminosAt;

    /**
     * Secciones creadas por el usuario.
     * 
     * Relación con las secciones donde el usuario es autor.
     */
    #[ORM\OneToMany(targetEntity: Section::class, mappedBy: 'autor', fetch: 'EXTRA_LAZY')]
    private Collection $sections;

    /**
     * Enlaces cortos creados por el usuario.
     * 
     * Relación con los enlaces cortos generados por el usuario.
     */
    #[ORM\OneToMany(targetEntity: EnlaceCorto::class, mappedBy: 'usuario')]
    private Collection $enlaceCortos;

    /**
     * Celebraciones creadas por el usuario.
     * 
     * Relación con los eventos de celebración creados por el usuario.
     */
    #[ORM\OneToMany(targetEntity: Celebracion::class, mappedBy: 'creaEvento')]
    private Collection $celebracions;

    /**
     * Indica si el usuario ha sido eliminado lógicamente.
     * 
     * Se utiliza para eliminación lógica en lugar de física.
     */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isDeleted;

    /**
     * Indica si el usuario está activo en el sistema.
     * 
     * Controla si el usuario puede acceder al sistema.
     */
    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isActive;

    /**
     * Constructor de la clase User.
     * 
     * Inicializa las colecciones de relaciones con otras entidades.
     */
    public function __construct()
    {
        $this->apiTokens = new ArrayCollection();
        $this->pageIndices = new ArrayCollection();
        $this->entradas = new ArrayCollection();
        $this->principal = new ArrayCollection();
        $this->comentarios = new ArrayCollection();
        $this->sections = new ArrayCollection();
        $this->enlaceCortos = new ArrayCollection();
        $this->celebracions = new ArrayCollection();
    }

    /**
     * Método para convertir el objeto a string.
     * 
     * Utilizado para representación en texto del usuario.
     * 
     * @return string Representación en texto del usuario (primer nombre)
     */
    public function __toString(): string
    {
        return (string) $this->getPrimerNombre();
    }

    /**
     * Obtiene el identificador único del usuario.
     * 
     * @return string|null El identificador UUID del usuario
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Obtiene el email del usuario.
     * 
     * @return string|null El email del usuario
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Establece el email del usuario.
     * 
     * @param string $email El nuevo email del usuario
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Obtiene el identificador público del usuario.
     * 
     * Utilizado por el sistema de seguridad de Symfony para identificar al usuario.
     * En este caso, se utiliza el email como identificador.
     *
     * @see UserInterface
     * 
     * @return string El identificador público del usuario (email)
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * Obtiene los roles del usuario.
     * 
     * Garantiza que todos los usuarios tengan al menos el rol ROLE_USER.
     * Los roles determinan los permisos del usuario en el sistema.
     *
     * @see UserInterface
     * 
     * @return array Lista de roles del usuario
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // Garantiza que cada usuario tenga al menos ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * Establece los roles del usuario.
     * 
     * @param array $roles Lista de roles a asignar al usuario
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Obtiene la contraseña cifrada del usuario.
     * 
     * Utilizado por el sistema de seguridad para verificar la autenticación.
     *
     * @see UserInterface
     * 
     * @return string|null La contraseña cifrada del usuario
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Borra las credenciales sensibles del usuario.
     * 
     * Este método se llama después de la autenticación para eliminar
     * datos sensibles temporales que no deberían persistir.
     *
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // Si almacenas datos temporales sensibles en el usuario, límpialos aquí
        // $this->plainPassword = null;
    }

    /**
     * Obtiene el primer nombre del usuario.
     * 
     * @return string|null El primer nombre del usuario
     */
    public function getPrimerNombre(): ?string
    {
        return $this->primerNombre;
    }

    /**
     * Establece el primer nombre del usuario.
     * 
     * @param string|null $primerNombre El nuevo primer nombre del usuario
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setPrimerNombre(?string $primerNombre): self
    {
        $this->primerNombre = $primerNombre;

        return $this;
    }

    /**
     * Establece la contraseña del usuario.
     * 
     * @param string $password La contraseña cifrada a establecer
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Obtiene el nombre de usuario en Twitter.
     * 
     * @return string|null El nombre de usuario en Twitter
     */
    public function getTwitterUsername(): ?string
    {
        return $this->twitterUsername;
    }

    /**
     * Establece el nombre de usuario en Twitter.
     * 
     * @param string|null $twitterUsername El nuevo nombre de usuario en Twitter
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setTwitterUsername(?string $twitterUsername): self
    {
        $this->twitterUsername = $twitterUsername;

        return $this;
    }

    /**
     * Obtiene la URL del avatar del usuario.
     * 
     * Si no se ha establecido un avatar personalizado, genera uno automáticamente
     * basado en el email del usuario utilizando el servicio Robohash.
     * 
     * @param string|null $size Tamaño opcional del avatar (en píxeles)
     * 
     * @return string|null La URL del avatar del usuario
     */
    public function getAvatarUrl(string $size = null): ?string
    {
        $url = 'https://robohash.org/'.$this->getEmail().'?set=set2';
        if ($size) {
            $url .= sprintf('&size=%dx%d', $size, $size);
        }

        return $url;
    }

    /**
     * Establece la URL del avatar del usuario.
     * 
     * @param string|null $avatarUrl La nueva URL del avatar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setAvatarUrl(?string $avatarUrl): self
    {
        $this->avatarUrl = $avatarUrl;

        return $this;
    }

    /**
     * Obtiene los tokens de API asociados al usuario.
     * 
     * @return Collection|ApiToken[] Colección de tokens de API
     */
    public function getApiTokens(): Collection
    {
        return $this->apiTokens;
    }

    /**
     * Añade un token de API al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y el token.
     * 
     * @param ApiToken $apiToken El token de API a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addApiToken(ApiToken $apiToken): self
    {
        if (!$this->apiTokens->contains($apiToken)) {
            $this->apiTokens[] = $apiToken;
            $apiToken->setUser($this);
        }

        return $this;
    }

    /**
     * Elimina un token de API del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y el token.
     * 
     * @param ApiToken $apiToken El token de API a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
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
     * Obtiene las páginas de índice creadas por el usuario.
     * 
     * @return Collection|PageIndex[] Colección de páginas de índice
     */
    public function getPageIndices(): Collection
    {
        return $this->pageIndices;
    }

    /**
     * Añade una página de índice al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y la página de índice.
     * 
     * @param PageIndex $pageIndex La página de índice a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addPageIndex(PageIndex $pageIndex): self
    {
        if (!$this->pageIndices->contains($pageIndex)) {
            $this->pageIndices[] = $pageIndex;
            $pageIndex->setAutor($this);
        }

        return $this;
    }

    /**
     * Elimina una página de índice del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y la página de índice.
     * 
     * @param PageIndex $pageIndex La página de índice a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
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
     * Obtiene las entradas creadas por el usuario.
     * 
     * @return Collection|Entrada[] Colección de entradas
     */
    public function getEntradas(): Collection
    {
        return $this->entradas;
    }

    /**
     * Añade una entrada al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y la entrada.
     * 
     * @param Entrada $entrada La entrada a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addEntrada(Entrada $entrada): self
    {
        if (!$this->entradas->contains($entrada)) {
            $this->entradas[] = $entrada;
            $entrada->setAutor($this);
        }

        return $this;
    }

    /**
     * Elimina una entrada del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y la entrada.
     * 
     * @param Entrada $entrada La entrada a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
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
     * Obtiene los elementos principales creados por el usuario.
     * 
     * @return Collection|Principal[] Colección de elementos principales
     */
    public function getPrincipal(): Collection
    {
        return $this->principal;
    }

    /**
     * Añade un elemento principal al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y el elemento principal.
     * 
     * @param Principal $principals El elemento principal a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addPrincipals(Principal $principals): self
    {
        if (!$this->principal->contains($principals)) {
            $this->principal[] = $principals;
            $principals->setAutor($this);
        }

        return $this;
    }

    /**
     * Elimina un elemento principal del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y el elemento principal.
     * 
     * @param Principal $principals El elemento principal a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
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
     * Obtiene los comentarios realizados por el usuario.
     * 
     * @return Collection|Comentario[] Colección de comentarios
     */
    public function getComentarios(): Collection
    {
        return $this->comentarios;
    }

    /**
     * Añade un comentario al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y el comentario.
     * 
     * @param Comentario $comentario El comentario a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addComentario(Comentario $comentario): self
    {
        if (!$this->comentarios->contains($comentario)) {
            $this->comentarios[] = $comentario;
            $comentario->setAutor($this);
        }

        return $this;
    }

    /**
     * Elimina un comentario del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y el comentario.
     * 
     * @param Comentario $comentario El comentario a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
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
     * Obtiene la fecha y hora en que el usuario aceptó los términos y condiciones.
     * 
     * @return \DateTimeInterface|null La fecha y hora de aceptación de términos
     */
    public function getAceptaTerminosAt(): ?\DateTimeInterface
    {
        return $this->aceptaTerminosAt;
    }

    /**
     * Registra la aceptación de términos y condiciones por parte del usuario.
     * 
     * Establece la fecha y hora actual como momento de aceptación.
     */
    public function aceptaTerminos()
    {
        $this->aceptaTerminosAt = new \DateTime();
    }

    /**
     * Obtiene las secciones creadas por el usuario.
     * 
     * @return Collection|Section[] Colección de secciones
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    /**
     * Añade una sección al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y la sección.
     * 
     * @param Section $section La sección a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addSection(Section $section): self
    {
        if (!$this->sections->contains($section)) {
            $this->sections[] = $section;
            $section->setAutor($this);
        }

        return $this;
    }

    /**
     * Elimina una sección del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y la sección.
     * 
     * @param Section $section La sección a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function removeSection(Section $section): self
    {
        if ($this->sections->contains($section)) {
            $this->sections->removeElement($section);
            // set the owning side to null (unless already changed)
            if ($section->getAutor() === $this) {
                $section->setAutor(null);
            }
        }

        return $this;
    }

    /**
     * Obtiene los enlaces cortos creados por el usuario.
     * 
     * @return Collection|EnlaceCorto[] Colección de enlaces cortos
     */
    public function getEnlaceCortos(): Collection
    {
        return $this->enlaceCortos;
    }

    /**
     * Añade un enlace corto al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y el enlace corto.
     * 
     * @param EnlaceCorto $enlaceCorto El enlace corto a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addEnlaceCorto(EnlaceCorto $enlaceCorto): self
    {
        if (!$this->enlaceCortos->contains($enlaceCorto)) {
            $this->enlaceCortos[] = $enlaceCorto;
            $enlaceCorto->setUsuario($this);
        }

        return $this;
    }

    /**
     * Elimina un enlace corto del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y el enlace corto.
     * 
     * @param EnlaceCorto $enlaceCorto El enlace corto a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function removeEnlaceCorto(EnlaceCorto $enlaceCorto): self
    {
        if ($this->enlaceCortos->contains($enlaceCorto)) {
            $this->enlaceCortos->removeElement($enlaceCorto);
            // set the owning side to null (unless already changed)
            if ($enlaceCorto->getUsuario() === $this) {
                $enlaceCorto->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * Obtiene las celebraciones creadas por el usuario.
     * 
     * @return Collection|Celebracion[] Colección de celebraciones
     */
    public function getCelebracions(): Collection
    {
        return $this->celebracions;
    }

    /**
     * Añade una celebración al usuario.
     * 
     * Establece la relación bidireccional entre el usuario y la celebración.
     * 
     * @param Celebracion $celebracion La celebración a añadir
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function addCelebracion(Celebracion $celebracion): self
    {
        if (!$this->celebracions->contains($celebracion)) {
            $this->celebracions[] = $celebracion;
            $celebracion->setCreaEvento($this);
        }

        return $this;
    }

    /**
     * Elimina una celebración del usuario.
     * 
     * Elimina la relación bidireccional entre el usuario y la celebración.
     * 
     * @param Celebracion $celebracion La celebración a eliminar
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function removeCelebracion(Celebracion $celebracion): self
    {
        if ($this->celebracions->removeElement($celebracion)) {
            // set the owning side to null (unless already changed)
            if ($celebracion->getCreaEvento() === $this) {
                $celebracion->setCreaEvento(null);
            }
        }

        return $this;
    }

    /**
     * Obtiene los roles del usuario como una cadena de texto.
     * 
     * Útil para mostrar los roles en interfaces de usuario.
     * 
     * @return string Los roles separados por comas
     */
    public function getRolesAsString(): string
    {
        return implode(',', $this->roles);
    }

    /**
     * Verifica si el usuario ha sido eliminado lógicamente.
     * 
     * @return bool|null true si el usuario está eliminado, false en caso contrario
     */
    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    /**
     * Establece el estado de eliminación lógica del usuario.
     * 
     * @param bool|null $isDeleted El nuevo estado de eliminación
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setIsDeleted(?bool $isDeleted): self
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Verifica si el usuario está activo en el sistema.
     * 
     * @return bool|null true si el usuario está activo, false en caso contrario
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * Establece el estado de activación del usuario.
     * 
     * @param bool|null $isActive El nuevo estado de activación
     * 
     * @return self Retorna la instancia actual para encadenamiento de métodos
     */
    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
