<?php

namespace App\Form;

use App\Entity\Brote;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class BroteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo')
            ->add('contenido')
            ->add('linkRoute')
            ->add('imageFilename')
            ->add('likes')
//            ->add('publicadoAt')
            ->add('activa')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('autor')
            ->add('entrada')
            ->add('principal')
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
                    'placeholder' => 'Ingrese una imagen para esta entrada',
                ],
            ])
            ->add('publicar', CheckboxType::class, [
                'mapped' => false,
                'label' => false,
                'required' => false,
                'help' => 'Habilitada para publicar.',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
//            ->add('startAt')
//            ->add('stopAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Brote::class,
        ]);
    }
}
