<?php

namespace App\Form;

use App\Entity\Entrada;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntradaComplexType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'titulo', TinymceType::class,
                [
                    'required' => true,
//                    'config' => [
//                        'uiColor' => '#ffffff',
//                        'language' => 'es',
//                        'input_sync' => true,
//                    ],
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Título de la entrada, se muestra en pantalla',
                    'attr' => [
                        'required' => true,
                        'height' => 300,

                    ],
                ]
            )
            ->add(
                'contenido',
                TinymceType::class,
                [
                    'required' => false,
//                    'config' => [
//                        'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
//                        'language' => 'es',
//                    ],
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Contenido de la entrada, se muestra en pantalla',
                    'attr' => [
                        'required' => false,
                        'height' => 300,
                    ],
                ]
            )
            ->add('guardarYPublicar', SubmitType::class, [
                'label' => 'Guardar y publicar en Notas',
                'attr' => ['class' => 'btn btn-success btn-round'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entrada::class,
        ]);
    }
}
