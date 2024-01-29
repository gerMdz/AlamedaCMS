<?php

namespace App\Form\Step\Entrada;

use App\Entity\Entrada;
use App\Entity\Section;
use App\Entity\User;
use App\Repository\UserRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepOneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'titulo',
                CKEditorType::class, [
                'required' => true,
                'config' => [
                    'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
                    'language' => 'es',
                    'input_sync' => true,
                ],
                'attr' => [
                    'required' => false,
                    'class' => 'form-control',
                ],
            ])
            ->add('contenido', CKEditorType::class, [
                'required' => false,
                'config' => [
                    'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
                    'language' => 'es',
                ],
                'attr' => [
                    'required' => false,
                    'rows' => 10,
//                    'class' => 'form-control',
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Entrada::class,
            ]
        );
    }
}
