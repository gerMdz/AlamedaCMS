<?php


namespace App\Form\Model;


use App\Validator\UniqueUser;
use Symfony\Component\Validator\Constraints as Assert;



class VoluntarioReservaRegistrationFormModel
{

    /**
     * @Assert\NotBlank(message="Por favor ingrese un nombre")
     */
    public $primerNombre;

}