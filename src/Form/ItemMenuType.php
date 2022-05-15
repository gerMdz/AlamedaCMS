<?php

namespace App\Form;

use App\Entity\ItemMenu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('role')
            ->add('label')
            ->add('badge')
            ->add('icon')
            ->add('isExterno')
            ->add('isActivo')
            ->add('pathLibre')
            ->add('orderitem')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('cssClass')
            ->add('identificador')
            ->add('parent')
            ->add('pathInterno')
            ->add('menu')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemMenu::class,
        ]);
    }
}
