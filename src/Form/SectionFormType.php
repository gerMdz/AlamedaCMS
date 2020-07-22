<?php


namespace App\Form;


use App\Entity\Section;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('cssClass')
            ->add('description', TextareaType::class, [
                'help'=>'Una descripción que diferencie a las otras secciones parecidas'
            ])
            ->add('identificador', TextType::class, [
                'help'=>'Opcional, normalmente para usar con funciones JS'
            ])
            ->add('disponible')
            ->add('disponibleAt', null,[
                'widget' => 'single_text'
            ])
            ->add('columns')
            ->add('startAt')
            ->add('stopAt')

            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Section::class
        ]);
    }


}