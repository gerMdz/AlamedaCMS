<?php

namespace App\Form;

use App\Entity\ModelTemplate;
use App\Entity\Principal;
use App\Repository\ModelTemplateRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PrincipalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'required' => false,
                    'class' => 'tinymce-editor',
                ],
            ])
            ->add('contenido', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'required' => false,
                    'class' => 'tinymce-editor',
                ],
            ])
            ->add('linkRoute', TextType::class, [
                'label' => 'linkRoute',
                'help' => 'Texto de la url ',
            ])
            ->add('isLinkExterno', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])
            ->add('linkPosting', TextType::class, [
                'required' => false,
                'label' => 'Link de redirección',
                'help' => 'Texto de la url externa ',
                'attr' => [
                    'class' => 'form-control',
                ],
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
                    'placeholder' => 'Ingrese una imagen para esta sección',
                ],
            ])
            ->add('autor', HiddenType::class, [
                'property_path' => 'autor.id',
                'attr' => [
                    'class' => 'hidden',
                ],
            ])
            ->add(
                'principal',
                EntityType::class,
                [
                    'class' => Principal::class,
                    'label' => 'Principal (parent)?',
                    'choice_label' => 'linkRoute',
                    'placeholder' => 'Seleccione parent principal',
                    'required' => false,
                    'help' => 'Es parte de un grupo de páginas?',
                    'attr' => [
                        'class' => 'select2-enable',
                        'placeholder' => 'Seleccione parent principal',
                    ],
                ]
            )
            ->add('cssClass', TextType::class, [
                'label' => 'Css',
                'help' => 'Agregar una clase css ya definida',
                'required' => false,
            ])
            ->add('modelTemplate', EntityType::class, [
                'class' => ModelTemplate::class,
                'query_builder' => fn (ModelTemplateRepository $er) => $er->findModelTemplatesByBlock('page'),
                'required' => false,
                'label' => 'Template',
                'help' => 'Plantilla ya definida',
                'placeholder' => 'Seleccione el modelo principal de la página',
                'attr' => [
                    'class' => 'select2-enable',
                ],
            ])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => false,
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])

        ; // final del builder
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Principal::class,
        ]);
    }
}
