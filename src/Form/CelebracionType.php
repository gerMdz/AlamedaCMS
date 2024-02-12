<?php

namespace App\Form;

use App\Entity\Celebracion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CelebracionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaCelebracionAt', DateTimeType::class, [
                'label' => 'Fecha Celebración',
                'widget' => 'single_text',
                'html5' => true,
                'required' => false,
                'format' => 'yyyy-MM-dd HH:mm',
                'attr' => ['class' => 'datetimepicker'],
            ])
            ->add('nombre')
            ->add('capacidad')
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
                'attr' => [
                    'class' => 'datetimepicker',
                    ],
            ])
            ->add('descripcion')
            ->add('isHabilitada', ChoiceType::class, [
                'required' => true,
                'label' => false,
                'help' => 'Habilita celebración',
                'choices' => [
                    'Si' => true,
                    'No' => false,
                ],
                'preferred_choices' => [true],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('imageQr')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Celebracion::class,
        ]);
    }
}
