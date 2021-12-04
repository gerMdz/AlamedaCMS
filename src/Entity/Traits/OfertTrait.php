<?php


namespace App\Entity\Traits;

use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


trait OfertTrait
{
    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("celebracion_read")
     */
    private $disponibleAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups("celebracion_read")
     */
    private $disponibleHastaAt;


    public function getDisponibleAt(): ?DateTimeInterface
    {
        return $this->disponibleAt;
    }

    public function setDisponibleAt(?DateTimeInterface $disponibleAt): self
    {
        $this->disponibleAt = $disponibleAt;

        return $this;
    }

    public function getDisponibleHastaAt(): ?DateTimeInterface
    {
        return $this->disponibleHastaAt;
    }

    public function setDisponibleHastaAt(?DateTimeInterface $disponibleHastaAt): self
    {
        $this->disponibleHastaAt = $disponibleHastaAt;

        return $this;
    }

}
