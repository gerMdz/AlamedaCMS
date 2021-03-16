<?php

namespace App\Form;

use App\Entity\Invitado;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvitadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telefono')
            ->add('dni')
            ->add('nombre')
            ->add('apellido')
            ->add('enlace')
            ->add('celebracion')
            ->add('email')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Invitado::class,
        ]);
    }
}
