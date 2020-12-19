<?php


namespace App\Form\Model;


use App\Validator\UniqueUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



class SectionFormModel
{
    /**
     * @Assert\NotBlank(message="Por favor ingrese una sección")
     * @ORM\Entity("App\Entity\Section")
     */
    public $section;

}