<?php

namespace App\Form;

use App\Entity\Entrada;
use App\Entity\ModelTemplate;
use App\Entity\Principal;
use App\Entity\User;
use App\Repository\ModelTemplateRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
            ->add('titulo', CKEditorType::class,
                [
                    'required' => true,
                    'config' => [
                        'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
                        'language' => 'es',
                        'input_sync' => true,
                    ],
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Título de la entrada, se muestra en pantalla',
                    'attr' => [
                        'required' => true,
                        'rows' => 10,
//                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'linkRoute',
                EntityType::class,
                [
                    'class' => Principal::class,
//                    'choice_label' => function (Principal $principal) {
//                        return sprintf('%s', $principal->getTitulo());
//                    },
                    'required' => false,
                    'help' => 'Link a páginas internas del sistema',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'attr' => [
                        'class' => 'select2-enable',
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
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Contenido de la entrada, se muestra en pantalla',
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
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                ]
            )
            ->add('linkPosting', TextType::class, [
                'required' => false,
                'label_attr' => [
                    'class' => 'text-primary',
                ],
                'help' => 'Link a páginas externos del sistema',
            ])
            ->add(
                'isLinkExterno',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-primary'],
                    'help' => '¿Abre otra página?',
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('footer', TextType::class, [
                    'label' => 'Pie de la entrada',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Texto secundario',
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
                    'label' => 'Imagen',
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

                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('disponibleAt', DateTimeType::class, [
                'label' => 'Disponible desde',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'format' => 'yyyy-MM-dd HH:mm',
                'attr' => ['class' => 'datetimepicker'],
            ])
            ->add('disponibleHastaAt', DateTimeType::class, [
                'label' => 'Disponible hasta',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'format' => 'yyyy-MM-dd HH:mm',
                'attr' => ['class' => 'datetimepicker'],
            ])
            ->add('eventoAt', DateTimeType::class, [
                'label' => 'Fecha Evento',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'format' => 'yyyy-MM-dd HH:mm',
                'attr' => ['class' => 'datetimepicker'],
            ])

//            ->add('section')
            ->add('orden', NumberType::class, [
                'label' => 'Orden en la sección',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => '¿Que orden tendrá?',
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'encabezado',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],

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

                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('contacto',null, [
                'label' => 'Contacto',
                'help' => 'Usar en caso excepcional, aún en desarrollo'
            ])
            ->add(
                'isSinTitulo',
                CheckboxType::class,
                [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
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
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                ]
            )
            ->add('cssClass',TextType::class,
                [
                    'label' => 'Clase css',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Agregar estilo css ya predefinido',
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'identificador',
                TextType::class,
                [
                    'label' => 'Identificador',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Identificador único #',
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            ); // ; Final Builder
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
