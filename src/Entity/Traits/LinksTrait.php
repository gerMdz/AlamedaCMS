<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait LinksTrait
{
    #[ORM\Column(nullable: true)]
    #[Groups('mail')]
    private ?bool $isLinkExterno;

    #[ORM\Column( nullable: true)]
    #[Groups('mail')]
    private ?string $linkPosting;

    #[ORM\Column(length: 150, nullable: true)]
    #[Groups('mail')]
    private ?string $linkRoute;

    public function getLinkRoute(): ?string
    {
        return $this->linkRoute;
    }

    public function setLinkRoute(?string $linkRoute): self
    {
        $this->linkRoute = $linkRoute;

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
}
