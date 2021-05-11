<?php


namespace App\Form\Step\Section;


use App\Entity\ModelTemplate;
use App\Entity\Section;
use App\Repository\ModelTemplateRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

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
            ->add('name', null, [
                'label' => 'Nombre de la sección',
                'help' => 'Nombre que identifica a la sección entre las otras secciones'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Descripción',
                'help' => 'Una descripción que diferencie a las otras secciones parecidas'
            ])

            ->add('principales', EntityType::class, [
                'class' => 'App\Entity\Principal',
                'label' => 'Página?',
                'placeholder' => 'Seleccione la página donde se insertará la sección',
                'required' => false,

            ])

            ; // Fin del builder




    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Section::class
        ]);
    }

}
