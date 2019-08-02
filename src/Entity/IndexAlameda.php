<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IndexAlamedaRepository")
 */
class IndexAlameda
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lema;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLema(): ?string
    {
        return $this->lema;
    }

    public function setLema(string $lema): self
    {
        $this->lema = $lema;

        return $this;
    }
}
