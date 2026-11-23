<?php

namespace App\Form\Step\Section;

use App\Entity\Section;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepThreeType extends AbstractType
{
    /**
     * SectionFormType constructor.
     */
    public function __construct(private readonly ManagerRegistry $registry)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cssClass', null, [
                'label' => 'Clase css',
                'help' => 'Las plantillas pueden aceptar class adicional, tenga en cuenta que debe ser una clase ya definida ',
            ])
            ->add('contenido', TextareaType::class, [
                'label' => 'Contenido',
                'help' => 'Opcional. El contenido de la sección se verá reflejado según la plantilla que elija',
                'required' => false,
                'attr' => [
                    'class' => 'tinymce-editor',
                ],
            ])
            ->add('disponible', CheckboxType::class, [
                'required' => false,
                'label' => 'Disponible?',
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
                'help' => 'Ya puede ser usado?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
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
