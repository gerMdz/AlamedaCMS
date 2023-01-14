<?php

namespace App\Form;

use App\Entity\Contacto;
use App\Entity\Organization;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nombre',
                'attr' => [
                    'placeholder' => 'Nombre',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('address1', TextType::class, [
                'label' => 'Dirección',
                'attr' => [
                    'placeholder' => 'Dirección',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('address2', TextType::class, [
                'label' => 'Dirección 2',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Dirección 2',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help'=>'Datos extra como piso o descripciones de la dirección'
            ])
            ->add('identifier', TextType::class, [
                'label' => 'Identificador',
                'attr' => [
                    'placeholder' => 'Nombre',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help'=>'Palabra clave única'
            ])
            ->add('responsable', TextType::class, [
                'label' => 'Responsable',
                'attr' => [
                    'placeholder' => 'Responsable',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
            ])
            ->add('owner', TextType::class, [
                'label' => 'Propietario',
                'attr' => [
                    'placeholder' => 'Propietario',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help'=>'Cuando la organización depende de otra organización o persona'
            ])
            ->add('email', EmailType::class, [
                'label' => '@',
                'attr' => [
                    'placeholder' => 'Dirección de mail',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help'=>'Correo principal de comunicación '
            ])
            ->add('isActive', CheckboxType::class, [
                'label_attr' => [
                    'class' => 'checkbox-switch',
                ],
                'label'=> 'Está activo',
                'attr' => [
                    'placeholder' => 'Activo',
                ],
                'row_attr' => [
                    'class' => 'form-floating',
                ],
                'help'=>'Activar la organización para que los datos sean visibles'
            ])
            ->add('contact', EntityType::class, [
                'class'=> Contacto::class,
                'label' => 'Contactos extras',
                'attr' => [
                    'placeholder' => 'Contactos',
                ],
                'row_attr' => [
                    'class' => 'form-select',
                ],
                'help'=>'Agregar contactos ya creados que estén vinculados'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Organization::class,
        ]);
    }
}
