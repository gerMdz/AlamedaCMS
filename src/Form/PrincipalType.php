<?php

namespace App\Form;

use App\Entity\Principal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PrincipalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('contenido')
            ->add('linkRoute')
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'maxSizeMessage' => 'La imagen no debe superar los 2MB',
                        'mimeTypesMessage' => 'El archivo no es considerada una imagen',
                    ]),
                ],

                'attr' => [
                    'placeholder' => 'Ingrese una imagen para esta sección',
                ],
            ])
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
            ->add('principal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Principal::class,
        ]);
    }
}
