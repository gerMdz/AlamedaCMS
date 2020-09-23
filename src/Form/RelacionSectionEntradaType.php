<?php

namespace App\Form;

use App\Entity\RelacionSectionEntrada;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RelacionSectionEntradaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orden')
            ->add('section')
            ->add('entrada')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RelacionSectionEntrada::class,
        ]);
    }
}
