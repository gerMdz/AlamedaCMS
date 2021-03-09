<?php

namespace App\Form;

use App\Entity\ModelTemplate;
use App\Entity\Principal;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
            ->add('titulo', CKEditorType::class, [
                'required' => false,
                'config' => [
                    'uiColor' => '#ffffff'],
                'attr' => [
                    'required' => false,
                    'class' => 'form-control',
                ],
            ])
            ->add('contenido', CKEditorType::class, [
                'required' => true,
                'config' => [
                    'uiColor' => '#ffffff'],
                'attr' => [
                    'required' => false,
                    'class' => 'form-control',
                ],
            ])
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
                'required' => false,
                'html5' => true,
                'label' => 'Creado',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr' => [
                    'readonly' => true
                ]
            ))
            ->add('updatedAt', DateTimeType::class, array(
                'widget' => 'single_text',
                'required' => false,
                'html5' => true,
                'label' => 'Editado',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr' => [
                    'readonly' => true
                ]
            ))
            ->add('autor', HiddenType::class, [
                'property_path' => 'autor.id',
                'attr' => [
                    'class' => 'hidden'
                ]
            ])
            ->add('principal')
            ->add('cssClass')
            ->add('modelTemplate', EntityType::class, [
                'class' => ModelTemplate::class,
                'required' => false,
                'label' => 'Template',
                'placeholder' => 'Seleccione el modelo principal de la página',
            ])

            ->add('isActive',CheckboxType::class, [
                'required' => false,
                'label' => 'Activa?',
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])

        ; //final del builder
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Principal::class,
        ]);
    }
}
