<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Exception;

#[ORM\Entity(repositoryClass: 'App\Repository\ApiTokenRepository')]
class ApiToken
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $token;

    #[ORM\Column(type: 'datetime')]
    private $expiraAt;

    /**
     * ApiToken constructor.
     *
     * @throws Exception
     */
    public function __construct(
        #[ORM\ManyToOne(inversedBy: 'apiTokens')]
        #[ORM\JoinColumn(nullable: false)]
        private User $user)
    {
        $this->token = bin2hex(random_bytes(60));
        $this->expiraAt = new \DateTime('+3 hour');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getExpiraAt(): ?\DateTimeInterface
    {
        return $this->expiraAt;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function renuevaExpirasAt()
    {
        $this->expiraAt = new \DateTime('+1 hour');
    }

    public function isExpired(): bool
    {
        return false;

        return $this->getExpiraAt() <= new \DateTime();
    }
}
