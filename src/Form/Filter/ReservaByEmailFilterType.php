<?php

namespace App\Form\Filter;

use App\Entity\Celebracion;
use App\Entity\Reservante;
use App\Repository\CelebracionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReservaByEmailFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('celebracion', EntityType::class, [
                'class' => Celebracion::class,
                'query_builder' => fn (CelebracionRepository $er) => $er->puedeMostrarse(),
                'label' => 'Celebración',
                'placeholder' => 'Seleccione Celebración',
                'invalid_message' => 'Por favor ingrese una celebración',
                'invalid_message_parameters' => 'Por favor ingrese celebración',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor seleccione una celebración',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Reserva',
                'attr' => [
                    'placeholder' => 'Por favor ingrese email de reserva',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese email de reserva',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservante::class,
        ]);
    }
}
