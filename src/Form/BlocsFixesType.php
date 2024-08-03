<?php

namespace App\Form;

use App\Entity\BlocsFixes;
use App\Entity\Principal;
use App\Entity\Section;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlocsFixesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('cssClass')
            ->add('imageFilename')
            ->add('identificador')
            ->add('page', EntityType::class, [
                'class' => Principal::class,
                'multiple' => true,
                'attr' => [
                    'class' => 'select2-enable',
                ],
                'required' => false,
            ])
            ->add('section', EntityType::class, [
                'class' => Section::class,
                'multiple' => true,
                'attr' => [
                    'class' => 'select2-enable',
                ],
                'required' => false,
            ])
            ->add('indexAlameda')
            ->add('fixes_type')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BlocsFixes::class,
        ]);
    }
}
