<?php


namespace App\Form\Step\Section;


use App\Entity\Section;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepOneType extends AbstractType
{

    private $registry;

    /**
     * SectionFormType constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        $this->registry = $registry;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                null,
                [
                    'label' => 'Nombre de la sección',
                    'help' => 'Que nombre tendrá la sección? Simple y que distinga a la sección de otras secciones',
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Descripción',
                    'help' => 'Describa la sección para saber que uso tendrá en la página',
                    'rows' => 2,
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'principal',
                EntityType::class,
                [
                    'class' => 'App\Entity\Principal',
                    'label' => 'Página?',
                    'choice_label' => 'linkRoute',
                    'placeholder' => 'Seleccione la página donde se insertará la sección',
                    'required' => false,
                    'help' => 'En qué página estará esta sección?',
                    'attr' => [
                        'class' => 'select2-enable',
                    ],

                ]
            ); // Fin del builder


    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Section::class,
            ]
        );
    }

}
