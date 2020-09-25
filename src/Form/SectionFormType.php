<?php

namespace App\Form;

use App\Entity\Brote;
use App\Entity\Principal;
use App\Entity\Section;
use Doctrine\Common\Persistence\ManagerRegistry;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class SectionFormType extends AbstractType
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
            ->add('name', null,[
                'label'=>'Nombre'
            ])
            ->add('cssClass', null, [
                'label'=>'Clase css'
            ])
            ->add('description', TextareaType::class, [
                'label'=>'Descripción',
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
            ->add('startAt', DateTimeType::class, array(
        'widget' => 'single_text',
        'required'=>false,
        'html5' => true,
        'label' => 'Comienza',
        'format' => 'dd-MM-yyyy HH:mm',
        'attr'=>[
            'class'=>'form-control datetimepicker'
        ]
    ))
            ->add('stopAt', DateTimeType::class, array(
                'widget' => 'single_text',
                'required'=>false,
                'html5' => true,
                'label' => 'Finaliza',
                'format' => 'dd-MM-yyyy HH:mm',
                'attr'=>[
                    'class'=>'form-control datetimepicker'
                ]
            ))
            ->add('principal', EntityType::class, [
                'class'=> 'App\Entity\Principal',
                'label'=>'Página?',
                'placeholder'=>'Seleccione la página donde se insertará la sección',
                'required'=>true,

            ] )
            ->add('template', TextType::class, [
                'help'=>'Opcional, llama a un templeta específico, debe estar en sections creado'
            ])
            ->add('contenido', CKEditorType::class, [
                'required' => true,
                'config' => [
                    'uiColor' => '#ffffff'],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('imageFile', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '2M',
                        'maxSizeMessage' => 'La imagen no debe superar los 2MB',
                        'mimeTypesMessage' => 'El archivo no es considerada una imagen',
                    ]),
                ],

                'attr' => [
                    'placeholder' => 'Ingrese una imagen para esta sección',
                ],
            ])

            ;
/**
 * Esto lo dejo por si alguna vez necesito campos dinámicos con validación
 */
//        $builder->addEventListener(
//            FormEvents::PRE_SET_DATA,
//            function (FormEvent $event){
//                /**@var Section|null $data **/
//                $data = $event->getData();
//                if(!$data){
//                    return;
//                }
//                $this->setupTypeSecondaryNameField(
//                    $event->getForm(),
//                    $data->getTypeOrigin()
//                );
//            }
//        );
//        $builder->get('typeOrigin')->addEventListener(
//            FormEvents::POST_SUBMIT,
//            function(FormEvent $event) {
//                $form = $event->getForm();
//                $this->setupTypeSecondaryNameField(
//                    $form->getParent(),
//                    $event->getData()
//                );
//            }
//        );



    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Section::class
        ]);
    }

//    private function getOriginNameChoices(string $origin = null){

//        switch ($origin){
//
//            case 'brote':
//                $data = $this->registry->getRepository(Brote::class)->getBrotesSelect();
//                $data = $this->combineArray($data);
//
//                break;
//            case 'principal':
//                $data = $this->registry->getRepository(Principal::class)->getPrincipalSelect();
//                $data = $this->combineArray($data);
//                break;
//            case 'index':
//            default:
//                $data = null;
//        }




//        return $data;


//    }

    /**
     * @param FormInterface $form
     * @param string|null $origin
     */
//    private function setupTypeSecondaryNameField(FormInterface $form, ?string $origin)
//    {
//        if(null === $origin){
//            $form->remove('typeSecondary');
//        }
//        $choices = $this->getOriginNameChoices($origin);
//        if (null === $choices) {
//            $form->remove('typeSecondary');
//            return;
//        }
//
//        $form->add('typeSecondary', ChoiceType::class, [
//            'label'=>'Página',
//            'placeholder'=>'Seleccione donde se agregará esta sección',
//            'choices' => $choices,
//            'required' => false,
//        ]);
//    }
//
//    private function combineArray($data){
//        $titulos = array_column($data, 'titulo');
//        $liks = array_column($data, 'linkRoute');
//        return array_combine($titulos, $liks);
//    }




}