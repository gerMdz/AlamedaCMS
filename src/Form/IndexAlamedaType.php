<?php

namespace App\Form;

use App\Entity\IndexAlameda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndexAlamedaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lema')
            ->add('lemaPrincipal')
            ->add('lemaSinEspacio')
            ->add('metaDescripcion')
            ->add('metaAutor')
            ->add('metaTitle')
            ->add('metaType')
            ->add('metaUrl')
            ->add('metaImage')
            ->add('base')
            ->add('section')
            ->add('template')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IndexAlameda::class,
        ]);
    }
}
