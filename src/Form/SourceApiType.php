<?php

namespace App\Form;

use App\Entity\SourceApi;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourceApiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('identifier')
            ->add('base_uri')
            ->add('base_endpoint')
            ->add('auth_basic')
            ->add('auth_bearer')
            ->add('auth_ntlm')
            ->add('base_auth')
            ->add('auth_username')
            ->add('auth_pass')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SourceApi::class,
        ]);
    }
}
