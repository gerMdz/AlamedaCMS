<?php

namespace App\Form\Step\Section;

use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepTwoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextareaType::class, [
                'label' => 'Titulo',
                'help' => 'El título de la sección se verá reflejado según la plantilla que elija',
                'required' => false,
                'attr' => [
                    'class' => 'tinymce-editor',
                ],
            ])
            ->add('identificador', TextType::class, [
                'label' => 'Identificador',
                'help' => 'Opcional, normalmente para usar con funciones JS, debe ser único',
            ])
            ->add('orden', IntegerType::class, [
                'label' => 'Orden en la página',
                'help' => 'Que orden tendrá en la página?',
                'required' => false,
            ])

        ; // Fin del builder
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Section::class,
            ]
        );
    }
}
