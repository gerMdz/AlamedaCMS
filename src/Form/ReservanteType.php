<?php

namespace App\Form;

use App\Entity\Celebracion;
use App\Entity\Reservante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class ReservanteType extends AbstractType
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
            ->add('telefono', TextType::class, [
                'label' => 'WhatsApp',
                'required' => false
            ])
            ->add('isPresente')
            ->add('documento', TextType::class, [
                'label' => 'Nro de documento',
                'help' => '(Solicitado por las autoridades como parte del protocolo)',
                'invalid_message' => 'Por favor ingrese solo números, sin puntos ni guiones',
                'invalid_message_parameters' => 'Por favor ingrese un valor mayor a 0',

                'attr' => [
                    'pattern'=>'\d+',
                    'oninput'=>'this.value=this.value.replace(/[^0-9]/g,"")'
                ]
            ])
            ->add('celebracion', HiddenType::class, [
                'property_path' => 'celebracion.id',
                'attr' => [
                    'class' => 'hidden'
                ]
            ])
            ->add('acompanantes', IntegerType::class, [
                'mapped' => false,
                'data' => 0,
                'invalid_message' => 'Por favor ingrese un valor menor o igual a 7',
                'invalid_message_parameters' => 'Por favor ingrese un valor menor o igual a 7',
                'label' => 'Cantidad de acompañantes',
                'attr' => ['min' => 0, 'max' => 7]
            ])
            ->add('save', SubmitType::class, array(
                'label' => 'Reservar',
                'attr' => array('class' => 'btn btn-primary btn--pill')
            ))
        ; // ;Final del builder

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservante::class,
        ]);
    }
}
