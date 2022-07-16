<?php

namespace App\Form;

use App\Entity\Comentario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComentarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenido')
            ->add('isDeleted')
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
            'data_class' => Comentario::class,
        ]);
    }
}
