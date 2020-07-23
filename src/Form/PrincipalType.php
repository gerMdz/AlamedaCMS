<?php

namespace App\Form;

use App\Entity\Principal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PrincipalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('contenido')
            ->add('linkRoute')
            ->add('imageFilename')
            ->add('likes')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('autor', HiddenType::class, [
                'property_path'=>'autor.id',
                'attr'=>[
                    'class'=>'hidden'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Principal::class,
        ]);
    }
}
