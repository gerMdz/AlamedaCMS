<?php

namespace App\Form\Step\Section;

use App\Entity\Section;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepTwoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', CKEditorType::class, [
                'label' => 'Titulo',
                'help' => 'El título de la sección se verá reflejado según la plantilla que elija',
                'required' => false,
                'config' => [
                    'uiColor' => '#fafafa'],
                'attr' => [
                    'class' => 'form-control',
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

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Section::class,
            ]
        );
    }
}
