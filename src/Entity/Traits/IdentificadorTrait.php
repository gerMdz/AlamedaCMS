<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait IdentificadorTrait
{
    #[ORM\Column(unique: true)]
    private ?string $identificador;

    public function getIdentificador(): ?string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador): self
    {
        $this->identificador = $identificador;

        return $this;
    }
}
