<?php

namespace App\Form;

use App\Entity\Derivada;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DerivadaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('contenido')
            ->add('linkRoute')
            ->add('imageFilename')
            ->add('likes')
            ->add('publicadoAt')
            ->add('activa')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('autor')
            ->add('entrada')
            ->add('principal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Derivada::class,
        ]);
    }
}
