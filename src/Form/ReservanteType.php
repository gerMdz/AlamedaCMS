<?php

namespace App\Form;

use App\Entity\Reservante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservanteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('apellido')
            ->add('nombre')
            ->add('telefono')
            ->add('isPresente')
            ->add('documento')
            ->add('celebracion')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservante::class,
        ]);
    }
}
