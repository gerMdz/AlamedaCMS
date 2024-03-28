<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait IdentificadorTrait
{
    #[ORM\Column(type: 'string', length: 150, unique: true)]
    private $identificador;

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
