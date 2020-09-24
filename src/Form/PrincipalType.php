<?php

namespace App\Form;

use App\Entity\Principal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('createdAt', DateTimeType::class, array(
                'widget' => 'single_text',
                'required'=>false,
                'html5' => true,
                'label' => 'Creado',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr'=>[
                    'readonly'=>true
                ]
            ))

            ->add('updatedAt', DateTimeType::class, array(
        'widget' => 'single_text',
        'required'=>false,
        'html5' => true,
        'label' => 'Editado',
        'format' => 'dd-MM-yyyy HH:mm',
        'attr'=>[
            'readonly'=>true
        ]
    ))
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
