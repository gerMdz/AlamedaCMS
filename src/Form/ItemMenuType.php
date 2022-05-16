<?php

namespace App\Form;

use App\Entity\ItemMenu;
use App\Entity\Roles;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemMenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rol')
            ->add('label')
            ->add('badge')
            ->add('icon')
            ->add('isExterno')
            ->add('isActivo')
            ->add('pathLibre')
            ->add('orderitem')
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
