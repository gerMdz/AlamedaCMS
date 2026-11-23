<?php

namespace App\Form\Step\Entrada;

use App\Entity\Entrada;
use App\Entity\Section;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepOneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'titulo',
                TextareaType::class, [
                'required' => true,
                'attr' => [
                    'required' => false,
                    'class' => 'tinymce-editor',
                ],
            ])
            ->add('contenido', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'required' => false,
                    'rows' => 10,
                    'class' => 'tinymce-editor',
                ],
            ])
            ->add(
                'section',
                EntityType::class,
                [
                    'class' => Section::class,
                    'mapped' => false,
                    'label' => 'Sección?',
                    'choice_label' => 'identificador',
                    'placeholder' => 'Seleccione la sección donde se insertará la entrada',
                    'required' => false,
                    'help' => 'En qué sección estará esta entrada?',
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                ]
            )
            ->add(
                'autor',
                EntityType::class,
                [
                    'class' => User::class,
                    'query_builder' => fn (UserRepository $ur) => $ur->findByRoleAutor(),
                    'label' => 'Autor?',
                    'choice_label' => 'primerNombre',
                    'placeholder' => 'Seleccione autor',
                    'required' => false,
                    'help' => 'Autor de la entrada entrada?',
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                ]
            )
        ; // Fin del builder
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
