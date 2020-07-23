<?php

namespace App\Form;

use App\Entity\MetaBase;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MetaBaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lema')
            ->add('lemaPrincipal')
            ->add('metaDescripcion')
            ->add('metaAutor')
            ->add('metaTitle')
            ->add('metaType')
            ->add('metaUrl')
            ->add('siteName')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MetaBase::class,
        ]);
    }
}
