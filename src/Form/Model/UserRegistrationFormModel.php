<?php


namespace App\Form\Model;


use App\Validator\UniqueUser;
use Symfony\Component\Validator\Constraints as Assert;



class UserRegistrationFormModel
{
    /**
     * @Assert\NotBlank(message="Por favor ingrese un email")
     * @Assert\Email()
     * @UniqueUser()
     */
    public $email;
    public $primerNombre;

    /**
     * @Assert\IsTrue(message="Por favor, debe aceptar los términos de amable convivencia.")
     */
    public $aceptaTerminos;

    /**
     * @Assert\NotBlank(message="Eliga una clave")
     * @Assert\Length(min=8, minMessage="Su clave debe tener al menos 8 dígitos")
     */
    public $plainPassword;
}