<?php

namespace App\Form;

use App\Entity\NewsSite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsSiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('srcSite')
            ->add('srcCodigo')
            ->add('isEnabled')
            ->add('srcType')
            ->add('srcParameters')
            ->add('identificador')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsSite::class,
        ]);
    }
}
