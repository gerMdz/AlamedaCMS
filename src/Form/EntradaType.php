<?php

namespace App\Form;

use App\Entity\Entrada;
use App\Entity\ModelTemplate;
use App\Entity\User;
use App\Repository\ModelTemplateRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
            //            Con steps
            ->add(
                'titulo',
                CKEditorType::class,
                [
                    'required' => true,
                    'config' => [
                        'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
                        'language' => 'es',
                        'input_sync' => true,
                    ],
                    'label_attr'=>[
                        'class' => 'text-primary'
                    ],
                    'attr' => [
                        'required' => false,
                        'rows' => 10,
//                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'linkRoute',
                TextType::class,
                [
                    'required' => false,
                    'label_attr'=>[
                        'class' => 'text-primary'
                    ],
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'contenido',
                CKEditorType::class,
                [
                    'required' => false,
                    'config' => [
                        'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
                        'language' => 'es',
                    ],
                    'label_attr'=>[
                        'class' => 'text-primary'
                    ],
                    'attr' => [
                        'required' => false,
                        'rows' => 10,
//                    'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'autor',
                EntityType::class,
                [
                    'class' => User::class,
                    'choice_label' => function (User $user) {
                        return sprintf('(%s) %s', $user->getPrimerNombre(), $user->getEmail());
                    },
                    'placeholder' => 'Seleccione Autor',
                    'invalid_message' => 'Por favor ingrese un autor',
                ]
            )
            ->add('linkPosting', TextType::class,[
                'label_attr'=>[
                    'class' => 'text-primary'
                ],
            ])
            ->add(
                'isLinkExterno',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-primary'],
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add(
                'footer',
                TextType::class,
                [
                    'label' => 'Pie de la entrada',
                    'label_attr'=>[
                        'class' => 'text-primary'
                    ],
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            //            Con steps hasta aquí

            ->add(
                'imageFile',
                FileType::class,
                [
                    'mapped' => false,
                    'required' => false,
                    'constraints' => [
                        new Image(
                            [
                                'maxSize' => '2M',
                                'maxSizeMessage' => 'La imagen no debe superar los 2MB',
                                'mimeTypesMessage' => 'El archivo no es considerada una imagen',
                            ]
                        ),
                    ],

                    'attr' => [
                        'placeholder' => 'Ingrese una imagen para esta entrada',
                    ],
                ]
            )
            ->add(
                'publicar',
                CheckboxType::class,
                [
                    'mapped' => false,
                    'label' => false,
                    'required' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('disponibleAt', DateTimeType::class, [
                'label_attr'=>[
                    'class' => 'text-primary'
                ],
            ])
            ->add('disponibleHastaAt', DateTimeType::class, [
                'label_attr'=>[
                    'class' => 'text-primary'
                ],
            ])
            ->add('eventoAt', DateTimeType::class, [
                'label_attr'=>[
                    'class' => 'text-primary'
                ],
            ])

//            ->add('section')
            ->add('orden')
            ->add(
                'encabezado',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add(
                'destacado',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('contacto')
            ->add(
                'isSinTitulo',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
//            ->add('sections',EntityType::class,[
//                'class'=>Section::class,
//                'multiple'=>true,
//                'expanded' => false,
//                'attr'=>[
//                    'class' => 'select2-enable form-check-input',
//                    'placeholder' => 'Seleccione '
//
//                ]
//            ])
            ->add(
                'isPermanente',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
//                'help' => 'Disponible?',
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )


            ->add(
                'modelTemplate',
                EntityType::class,
                [
                    'class' => ModelTemplate::class,
                    'query_builder' => function (ModelTemplateRepository $er) {
                        return $er->findByTypeEntrada();
                    },
                    'help' => 'Opcional, llama a un template específico, debe estar en sections creado',
                    'required' => false,
                ]
            )
        ; // ; Final Builder
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Entrada::class,
            ]
        );
    }
}
