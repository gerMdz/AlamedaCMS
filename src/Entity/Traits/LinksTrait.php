<?php


namespace App\Entity\Traits;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait LinksTrait
{
    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @Groups("mail")
     */
    private $isLinkExterno;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("mail")
     */
    private $linkPosting;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Groups("mail")
     */
    private $linkRoute;

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