<?php

namespace App\Form;

use App\Entity\GroupCelebration;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupCelebrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isActivo')
            ->add('baseCss')
            ->add('btonCss')
            ->add('imageBg')
//            ->add('celebraciones')
            ->add('imageFilename')
            ->add('title')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupCelebration::class,
        ]);
    }
}
