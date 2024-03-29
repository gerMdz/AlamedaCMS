<?php

namespace App\Form;

use App\Entity\TypeBlock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TypeBlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Que nombre tendrá el nuevo TypeBlock?',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Agregue una descripción para el nuevo TypeBlock',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('identifier', TextType::class, [
                'label' => 'Agregue un identificador único para el nuevo TypeBlock',
                'help' => 'En minúsculas y sin espacios, puede usar guiones medios "-"',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('isActive', CheckboxType::class, [
                'required' => false,
                'label' => 'Activa el TypeBlock?',
                'label_attr' => ['class' => 'form-check-label'],
                'attr' => [
                    'class' => 'form-check-input text-dark',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TypeBlock::class,
        ]);
    }
}
