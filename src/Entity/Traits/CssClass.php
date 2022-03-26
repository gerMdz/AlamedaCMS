<?php


namespace App\Entity\Traits;


use Doctrine\ORM\Mapping as ORM;

trait CssClass
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $cssClass;

    public function getCssClass(): ?string
    {
        return $this->cssClass;
    }

    public function setCssClass(?string $cssClass): self
    {
        $this->cssClass = $cssClass;

        return $this;
    }
}