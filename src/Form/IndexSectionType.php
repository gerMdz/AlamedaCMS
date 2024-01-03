<?php

namespace App\Form;

use App\Entity\IndexAlameda;
use App\Entity\Section;
use App\Repository\SectionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndexSectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('section', EntityType::class, [
                'class' => Section::class,
                'mapped' => false,
                'placeholder' => 'Seleccione sección',
                'label' => 'Secciones disponibles',
                'query_builder' => fn (SectionRepository $er) => $er->findDisponible(),

                'attr' => [
                    'class' => 'select2-enable',
                    'placeholder' => 'Seleccione sección',
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Agregar', 'attr' => ['class' => 'btn btn-primary btn--pill']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => IndexAlameda::class,
        ]);
    }
}
