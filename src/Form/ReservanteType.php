<?php

namespace App\Form;

use App\Entity\Celebracion;
use App\Entity\Reservante;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ])
            ->add('celebracion', HiddenType::class,[
                'property_path'=>'celebracion.id',
                'attr'=>[
                    'class'=>'hidden'
                ]
            ])
            ->add('acompanantes', IntegerType::class,[
                'mapped'=>false,
                'label'=>'Cantidad de acompañantes',
            ])
        ; // ;Final del builder

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservante::class,
        ]);
    }
}
