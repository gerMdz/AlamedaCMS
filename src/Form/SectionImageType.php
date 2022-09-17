<?php

namespace App\Form;

use App\Entity\SectionImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nOrder')
            ->add('isPrincipal')
            ->add('isUsable')
            ->add('filter')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('sectionId')
            ->add('imageId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SectionImage::class,
        ]);
    }
}
