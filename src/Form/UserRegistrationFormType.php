<?php

namespace App\Form;


use App\Form\Model\UserRegistrationFormModel;
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
                'invalid_message' => 'Las claves deben coincidir.',
                'options' => ['attr' => ['class' => 'password-field']],
                'help' => 'Min 5 caracteres',
                'help_html' => true,
                'first_options' => ['label' => 'Password',
                    'help' => 'Min 5 caracteres'],
                'second_options' => ['label' => 'Repetir Password'],
                'required' => true,

            ])
            ->add('aceptaTerminos', CheckboxType::class, [
                    'label' => 'Acepto',
                    'help' => 'Acepta los términos de una amable conviviencia (Serás parte de nuestra comunidad virtual)',
                ]
            )
//            ->add('twitterUsername')
//            ->add('avatarUrl')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserRegistrationFormModel::class,
        ]);
    }
}
