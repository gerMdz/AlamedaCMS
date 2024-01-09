<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait OfertTrait
{
    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $disponibleAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $disponibleHastaAt;

    public function getDisponibleAt(): ?\DateTimeInterface
    {
        return $this->disponibleAt;
    }

    public function setDisponibleAt(?\DateTimeInterface $disponibleAt): self
    {
        $this->disponibleAt = $disponibleAt;

        return $this;
    }

    public function getDisponibleHastaAt(): ?\DateTimeInterface
    {
        return $this->disponibleHastaAt;
    }

    public function setDisponibleHastaAt(?\DateTimeInterface $disponibleHastaAt): self
    {
        $this->disponibleHastaAt = $disponibleHastaAt;

        return $this;
    }
}
