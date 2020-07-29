<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Sodium\add;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
//            ->add('roles')
            ->add('primerNombre')
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Las claves deben coincidir.',
                'options' => ['attr' => ['class' => 'password-field']],
                'help' => 'Min 5 caracteres',
                'help_html' => true,
                'first_options' => ['label' => 'Password',
                    'help' => 'Min 5 caracteres'],
                'second_options' => ['label' => 'Repetir Password'],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor eliga una clave'
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'La clave no puede ser tan corta, 5 caracteres min.'
                    ])
                ]
            ])
            ->add('aceptaTerminos', CheckboxType::class, [
                    'label' => 'Acepto',
                    'help' => 'Acepta los términos de una amable conviviencia (Serás parte de nuestra comunidad virtual)',
                    'mapped' => false,
                    'constraints' => [
                        new IsTrue([
                                'message' => 'Por favor, debe aceptar los términos de amable convivencia.'
                            ]
                        )],
                ]
            )
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
