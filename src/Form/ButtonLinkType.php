<?php

namespace App\Form;

use App\Entity\ButtonLink;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ButtonLinkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cssClass')
            ->add('linkRoute')
            ->add('isLinkExterno')
            ->add('textButton')
            ->add('sections')
            ->add('principals')
            ->add('entradas')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ButtonLink::class,
        ]);
    }
}
