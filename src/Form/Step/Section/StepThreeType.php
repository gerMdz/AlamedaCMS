<?php


namespace App\Form\Step\Section;


use App\Entity\Section;
use Doctrine\Common\Persistence\ManagerRegistry;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepThreeType extends AbstractType
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
            ->add('cssClass', null, [
                'label' => 'Clase css',
                'help' => 'Las plantillas pueden aceptar class adicional, tenga en cuenta que debe ser una clase ya definida '
            ])
            ->add('contenido', CKEditorType::class, [
                'label'=>'Contenido',
                'help' =>'Opcional. El contenido de la sección se verá reflejado según la plantilla que elija',
                'required' => false,
                'config' => [
                    'uiColor' => '#fafafa'],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('disponible', CheckboxType::class, [
                'required' => false,
                'label' => 'Disponible?',
                'label_attr' => ['class' => 'checkbox-custom text-dark'],
                'help' => 'Ya puede ser usado?',
                'attr' => [
                    'class' => 'form-check-input ',
                ],
            ])

        ; // Fin del builder


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
