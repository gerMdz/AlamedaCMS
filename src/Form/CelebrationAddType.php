<?php

namespace App\Form;

use App\Entity\Celebracion;
use App\Form\Model\CelebrationsFormModel;
use App\Repository\CelebracionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CelebrationAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('celebration', EntityType::class, [
                'class' => Celebracion::class,
                'mapped' => false,
                'placeholder' => 'Seleccione celebración',
                'label' => 'Celebraciones disponibles',
                'query_builder' => fn (CelebracionRepository $er) => $er->puedeAgruparse(),

                'attr' => [
                    'class' => 'select2-enable',
                    'placeholder' => 'Seleccione celebracion',
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Agregar', 'attr' => ['class' => 'btn btn-primary btn--pill']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CelebrationsFormModel::class,
        ]);
    }
}
