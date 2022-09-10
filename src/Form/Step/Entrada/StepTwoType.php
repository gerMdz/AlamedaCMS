<?php


namespace App\Form\Step\Entrada;


use App\Entity\Entrada;
use App\Entity\Section;
use App\Entity\User;
use App\Repository\SectionRepository;
use App\Repository\UserRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepTwoType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('linkRoute', TextType::class, [
                'required' => false,
                'help'=>'Tiene un link interno? No debe contener link externo',
                'attr' => [
                    'class' => 'form-control',
                    'list'          => 'LinkRoutes'
                ],
            ])
            ->add('linkPosting', TextType::class, [
                'label'=>'Link Externo al sitio',
                'required' => false,
                'help'=>'Tiene un link externo? No debe contener linkRoute',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add(
                'isLinkExterno',
                CheckboxType::class,
                [
                    'help'=>'Debe abrirse el enlace en una ventana nueva?',
                    'required' => false,
                    'label' => 'Abre otra ventana o pestaña?',
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
            ->add(
                'footer',
                TextType::class,
                [
                    'label' => 'Pie de la entrada',
                    'help'=> 'Puede usarse cómo texto de un enlace o botón (depende de la plantilla',
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )

        ; // Fin del builder
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Entrada::class,
            ]
        );
    }
}
