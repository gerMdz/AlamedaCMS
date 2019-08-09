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
            ->add('horario1')
            ->add('horario2')
            ->add('textoVersiculo')
            ->add('versiculo')
            ->add('metaDescripcion')
            ->add('metaAutor')
            ->add('metaTitle')
            ->add('metaType')
            ->add('metaUrl')
            ->add('metaImage')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IndexAlameda::class,
        ]);
    }
}
