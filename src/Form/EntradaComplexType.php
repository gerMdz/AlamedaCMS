<?php

namespace App\Form;

use App\Entity\Entrada;
use App\Entity\ModelTemplate;
use App\Entity\User;
use App\Repository\ModelTemplateRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class EntradaComplexType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo', TextareaType::class, [
                'required' => true,
//                'config' => [
//                    'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
//                    'language' => 'es',
//                    'input_sync' => true
//                    ],
                'attr' => [
                    'required' => false,
                    'class' => 'summernote',
                ],
            ])

            ->add('contenido', TextareaType::class, [
                'required' => false,

                'attr' => [
                    'required' => false,
                    'class' => 'summernote',
                ],
            ])

        ; // ; Final Builder
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entrada::class,
        ]);
    }
}
