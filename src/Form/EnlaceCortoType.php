<?php

namespace App\Form;

use App\Entity\EnlaceCorto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnlaceCortoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('linkRoute')
            ->add('urlDestino')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('usuario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EnlaceCorto::class,
        ]);
    }
}
