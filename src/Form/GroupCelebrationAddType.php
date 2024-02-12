<?php

namespace App\Form;

use App\Entity\GroupCelebration;
use App\Form\Model\GroupCelebrationsFormModel;
use App\Repository\GroupCelebrationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupCelebrationAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('groupCelebration', EntityType::class, [
                'class' => GroupCelebration::class,
                'mapped' => false,
                'placeholder' => 'Seleccione grupo',
                'label' => 'Grupos disponibles',
                'query_builder' => fn (GroupCelebrationRepository $er) => $er->findByActive(),

                'attr' => [
                    'class' => 'select2-enable',
                    'placeholder' => 'Seleccione grupo',
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Agregar', 'attr' => ['class' => 'btn btn-primary btn--pill']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GroupCelebrationsFormModel::class,
        ]);
    }
}
