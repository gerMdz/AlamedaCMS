<?php

namespace App\Form;

use App\Entity\WaitingList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvisoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('apellido', TextType::class, [
                'label' => 'Apellido'
            ])
            ->add('nombre', TextType::class, [
                'required' => false,
                'label' => 'Nombre'
            ])
            ->add('celebracion', HiddenType::class, [
                'property_path' => 'celebracion.id',
                'attr' => [
                    'class' => 'hidden'
                ]
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Avisarme',
                'attr' => array('class' => 'btn btn-primary btn--pill')
            )); // ;Final del builder

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => WaitingList::class,
        ]);
    }
}
