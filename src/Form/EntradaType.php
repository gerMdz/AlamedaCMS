<?php

namespace App\Form;

use App\Entity\Contacto;
use App\Entity\Entrada;
use App\Entity\ModelTemplate;
use App\Entity\Principal;
use App\Entity\Section;
use App\Entity\User;
use App\Repository\ModelTemplateRepository;
use App\Repository\PrincipalRepository;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class EntradaType extends AbstractType
{
    /**
     * EntradaType constructor.
     */
    public function __construct(private readonly PrincipalRepository $principalRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $linkRouteChoices = [];
        $links = $this->principalRepository->findAll();
        foreach ($links as $link) {
            $linkRouteChoices[strip_tags($link->__toString())] = $link->getLinkRoute();
        }

        $builder
            ->add('encabezado', CheckboxType::class, [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('destacado', CheckboxType::class, [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('isSinTitulo', CheckboxType::class, [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('isPermanente', CheckboxType::class, [
                    'required' => false,
                    'label' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],

                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('publicar', CheckboxType::class, [
                    'mapped' => false,
                    'label' => false,
                    'required' => false,
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],

                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add('titulo', TextareaType::class,
                [
                    'required' => true,
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Título de la entrada, se muestra en pantalla',
                    'attr' => [
                        'required' => false,
                        'class' => 'tinymce-editor',
                    ],
                ]
            )
            ->add(
                'linkRoute',
                ChoiceType::class,
                [
                    'choices' => $linkRouteChoices,
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
                TextareaType::class,
                [
                    'required' => false,
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Contenido de la entrada, se muestra en pantalla',
                    'attr' => [
                        'required' => false,
                        'rows' => 20,
                        'class' => 'tinymce-editor form-control',
                    ],
                ]
            )
            ->add('footer', TextType::class, [
                    'label' => 'Pie de la entrada',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Texto secundario',
                    'help_attr' => [
                        'class' => ' text-secondary',
                    ],
                    'attr' => [
                        'placeholder' => 'Pie de entrada',
                    ],
                    'required' => false,

                    'row_attr' => [
                        'class' => 'form-floating',
                    ],
                ]
            )
            ->add('linkRoute', EntityType::class, [
                    'class' => Principal::class,
                    'mapped' => false,
                    'required' => false,
                    'help' => 'Link a páginas internas del sistema',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating',
                    ],
                ]
            )
            ->add('linkPosting', TextType::class, [
                    'label' => 'Link Posting',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Link de redirección',
                    'help_attr' => [
                        'class' => ' text-secondary',
                    ],
                    'attr' => [
                        'placeholder' => 'Link posting',
                    ],
                    'required' => false,

                    'row_attr' => [
                        'class' => 'form-floating',
                    ],
                ]
            )
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
            ->add('eventoAt', DateTimeType::class, [
                'label' => 'Fecha Evento',
                'widget' => 'single_text',
                'placeholder' => 'Seleccione día y hora',
                'html5' => true,
                'required' => false,
                'attr' => ['class' => 'form-control '],
                'input' => 'datetime',
            ])
            ->add('disponibleAt', DateTimeType::class, [
                'label' => 'Disponible desde',
                'widget' => 'single_text',
                'placeholder' => 'Seleccione día y hora',
                'html5' => true,
                'required' => false,
                'attr' => ['class' => 'form-control '],
                'input' => 'datetime',
            ])
            ->add('disponibleHastaAt', DateTimeType::class, [
                'label' => 'Disponible hasta',
                'widget' => 'single_text',
                'placeholder' => 'Seleccione día y hora',
                'html5' => true,
                'required' => false,
                'attr' => ['class' => 'form-control '],
                'input' => 'datetime',
            ])
            ->add(
                'autor',
                EntityType::class,
                [
                    'class' => User::class,
                    'choice_label' => fn(User $user) => sprintf('(%s) %s', $user->getPrimerNombre(), $user->getEmail()),
                    'placeholder' => 'Seleccione Autor',
                    'invalid_message' => 'Por favor ingrese un autor',
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                ]
            )
            ->add(
                'modelTemplate',
                EntityType::class,
                [
                    'class' => ModelTemplate::class,
                    'query_builder' => fn(ModelTemplateRepository $er) => $er->findByTypeEntrada(),
                    'help' => 'Opcional, llama a un template específico, debe estar en sections creado',
                    'required' => false,
                    'attr' => [
                        'class' => 'select2-enable',
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
            ->add('disponibleAt', DateTimeType::class, [
                'label' => 'Disponible desde',
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
            ])
            ->add('disponibleHastaAt', DateTimeType::class, [
                'label' => 'Disponible hasta',
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
                'attr' => ['class' => 'datetimepicker'],
            ])
            ->add('eventoAt', DateTimeType::class, [
                'label' => 'Fecha Evento',
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
                'attr' => ['class' => 'datetimepicker'],
            ])

            ->add('orden', NumberType::class, [
                    'label' => 'Orden',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => '¿Que orden tendrá en la sección?',
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Orden',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating',
                    ],
                    'help_attr' => [
                        'class' => ' text-secondary',
                    ],
                ]
            )
            ->add('contacto', EntityType::class, [
                'class' => Contacto::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Contacto',
                'help' => 'Usar en caso excepcional, aún en desarrollo',
                'label_attr' => [
                    'class' => 'text-primary',
                ],
                'required' => false,
                'attr' => [
                    'placeholder' => 'Contacto',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help_attr' => [
                    'class' => ' text-secondary',
                ],
            ])
            ->add('cssClass', TextType::class,
                [
                    'help_attr' => [
                        'class' => ' text-secondary',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating',
                    ],
                    'label' => 'Clase css',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Agregar estilo css ya predefinido',
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Estilos CSS',
                    ],
                ]
            )
            ->add(
                'identificador', TextType::class, [
                    'label' => 'Identificador',
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Identificador único #',
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Identificador',
                    ],
                    'row_attr' => [
                        'class' => 'form-floating',
                    ],
                    'help_attr' => [
                        'class' => ' text-secondary',
                    ],
                ]
            )
            ->add('sections', EntityType::class, [
                'class' => Section::class,
                'multiple' => true,
                'help' => 'Opcional, seleccione la sección/es',
                'required' => false,
                'attr' => [
                    'class' => 'select2-enable',
                ],
            ]); // ; Final Builder
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Entrada::class,
            ]
        );
    }
}
