<?php

namespace App\Form;

use App\Entity\BlocsFixes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlocsFixesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('cssClass')
            ->add('imageFilename')
            ->add('identificador')
            ->add('page')
            ->add('section')
            ->add('indexAlameda')
            ->add('fixes_type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlocsFixes::class,
        ]);
    }
}
