<?php

namespace App\Form;

use App\Entity\ItemFeed;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemFeedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('descripcion')
            ->add('pubDateAt')
            ->add('linkUrl')
            ->add('linkType')
            ->add('linkLength')
            ->add('linkLongitud')
            ->add('duracion')
            ->add('guid')
            ->add('channelFeed')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ItemFeed::class,
        ]);
    }
}
