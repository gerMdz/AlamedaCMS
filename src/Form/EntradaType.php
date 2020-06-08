<?php

namespace App\Form;

use App\Entity\Entrada;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\IsFalse;
use Symfony\Component\Validator\Constraints\IsTrue;

class EntradaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('linkRoute', TextType::class, [
                'required'=>false,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('contenido', TextareaType::class, [
                'required'=>true,
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('autor', HiddenType::class, [
                'property_path'=>'autor.id',
                'attr'=>[
                    'class'=>'hidden'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'mapped'=>false,
                'required'=>false,
                'constraints'=>[
                    new Image([
                        'maxSize'=>'2M',
                        'maxSizeMessage'=>'La imagen no debe superar los 2MB',
                        'mimeTypesMessage'=>'El archivo no es considerada una imagen',
                    ])
                ],

                'attr'=>[
                    'placeholder'=> 'Ingrese una imagen para esta entrada'
                ]
            ])
            ->add('publicar',CheckboxType::class, [
                'mapped'=>false,
                'label'=>false,
                'required'=>false,
                'help' => 'Habilitada para publicar.',
                'attr'=>[
                    'class'=>'form-control'
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entrada::class,
        ]);
    }
}
