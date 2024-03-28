<?php

namespace App\Entity;

use App\Repository\SourceApiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SourceApiRepository::class)]
class SourceApi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $identifier;

    #[ORM\Column(type: 'string', length: 255)]
    private $base_uri;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $auth_basic;

    #[ORM\Column(type: 'string', length: 510, nullable: true)]
    private $auth_bearer;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $auth_ntlm;

    #[ORM\Column(type: 'string', length: 510, nullable: true)]
    private $base_auth;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $auth_username;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $auth_pass;

    #[ORM\Column(type: 'string', length: 510)]
    private $base_endpoint;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getBaseUri(): ?string
    {
        return $this->base_uri;
    }

    public function setBaseUri(string $base_uri): self
    {
        $this->base_uri = $base_uri;

        return $this;
    }

    public function getAuthBasic(): ?string
    {
        return $this->auth_basic;
    }

    public function setAuthBasic(?string $auth_basic): self
    {
        $this->auth_basic = $auth_basic;

        return $this;
    }

    public function getAuthBearer(): ?string
    {
        return $this->auth_bearer;
    }

    public function setAuthBearer(?string $auth_bearer): self
    {
        $this->auth_bearer = $auth_bearer;

        return $this;
    }

    public function getAuthNtlm(): ?string
    {
        return $this->auth_ntlm;
    }

    public function setAuthNtlm(?string $auth_ntlm): self
    {
        $this->auth_ntlm = $auth_ntlm;

        return $this;
    }

    public function getBaseAuth(): ?string
    {
        return $this->base_auth;
    }

    public function setBaseAuth(?string $base_auth): self
    {
        $this->base_auth = $base_auth;

        return $this;
    }

    public function getAuthUsername(): ?string
    {
        return $this->auth_username;
    }

    public function setAuthUsername(?string $auth_username): self
    {
        $this->auth_username = $auth_username;

        return $this;
    }

    public function getAuthPass(): ?string
    {
        return $this->auth_pass;
    }

    public function setAuthPass(?string $auth_pass): self
    {
        $this->auth_pass = $auth_pass;

        return $this;
    }

    public function getBaseEndpoint(): ?string
    {
        return $this->base_endpoint;
    }

    public function setBaseEndpoint(string $base_endpoint): self
    {
        $this->base_endpoint = $base_endpoint;

        return $this;
    }
}
