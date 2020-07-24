<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
//            ->add('roles')
            ->add('primerNombre')
            ->add('plainPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'mapped'=>false,
                'invalid_message' => 'Las claves deben coincidir.',
                'options' => ['attr' => ['class' => 'password-field']],
                'help'=>'Min 5 caracteres',
                'help_html'=>true,
                'first_options'  => ['label' => 'Password',
                    'help'=>'Min 5 caracteres'],
                'second_options' => ['label' => 'Repetir Password'],
                'required'=>true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor eliga una clave'
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'La clave no puede ser tan corta, 5 caracteres min.'
                    ])
                ]







    ]);
//            ->add('twitterUsername')
//            ->add('avatarUrl')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
