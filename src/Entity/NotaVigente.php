<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class NotaVigente
{
    public const ID = 1;

    #[ORM\Id]
    #[ORM\Column]
    private int $id = self::ID;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(onDelete: 'SET NULL')]
    private ?Entrada $entrada = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $titulo = null;

    #[ORM\Column(type: 'text')]
    private string $contenido;

    public function publicar(Entrada $entrada): void
    {
        $this->entrada = $entrada;
        $this->titulo = $entrada->getTitulo();
        $this->contenido = (string) $entrada->getContenido();
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function getContenido(): string
    {
        return $this->contenido;
    }
}
