<?php

namespace App\Form;

use App\Entity\Entrada;
use App\Entity\User;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class EntradaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('linkRoute', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('contenido', CKEditorType::class, [
                'required' => false,
                'config' => [
                    'uiColor' => '#ffffff'],
                'attr' => [
                    'required' => false,
                    'class' => 'form-control',
                ],
            ])
            ->add('autor', EntityType::class, [
                'class'=>User::class,
                'choice_label' => function(User $user) {
                    return sprintf('(%s) %s', $user->getPrimerNombre(), $user->getEmail());
                },
                'placeholder'=> 'Seleccione Autor',
                'invalid_message' => 'Por favor ingrese un autor'
            ])
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
                    'placeholder' => 'Ingrese una imagen para esta entrada',
                ],
            ])
            ->add('publicar', CheckboxType::class, [
                'mapped' => false,
                'label' => false,
                'required' => false,
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])
            ->add('disponibleAt')
            ->add('disponibleHastaAt')
            ->add('eventoAt')
            ->add('linkPosting')
            ->add('section')
            ->add('orden')
            ->add('encabezado', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])
            ->add('destacado', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])
            ->add('contacto')
            ->add('isSinTitulo', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])
            ->add('sections')
            ->add('isPermanente',CheckboxType::class, [
                'required' => false,
                'label' => false,
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])

        ; // ; Final Builder
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entrada::class,
        ]);
    }
}
