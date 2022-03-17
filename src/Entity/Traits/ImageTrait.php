<?php


namespace App\Entity\Traits;


use App\Service\UploaderHelper;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait ImageTrait
{
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("mail")
     */
    private ?string $imageFilename;

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename(?string $imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return UploaderHelper::IMAGE_ENTRADA.'/'.$this->getImageFilename();
    }
}