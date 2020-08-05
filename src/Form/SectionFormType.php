<?php


namespace App\Form;


use App\Entity\Brote;
use App\Entity\IndexAlameda;
use App\Entity\Principal;
use App\Entity\Section;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('startAt')
            ->add('stopAt')
            ->add('typeOrigin', ChoiceType::class, [
                'label'=>'Origen',
                'placeholder'=>'Seleccione el tipo de origen',
                'choices'=>[
                'Principal' => 'principal',
                'Brote' => 'brote',
                'Index'=>'index'
                ],
                'required'=>false,
            ] )
            ->add('typeSecondary', ChoiceType::class,[
                'label'=>'Página',
                'placeholder'=>'Seleccione donde se agregará esta sección',
                'choices'=>[
                    'HACER'=>'HACER'
                ],
                'required'=>false,
            ])

            ;
        $builder->get('typeOrigin')->addEventListener(
            FormEvents::POST_SUBMIT,
            function(FormEvent $event) {
                $form = $event->getForm();
                $this->setupTypeSecondaryNameField(
                    $form->getParent(),
                    $event->getData()
                );
            }
        );



    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Section::class
        ]);
    }

    private function getOriginNameChoices(string $origin){

        switch ($origin){

            case 'brote':
                $data = $this->registry->getRepository(Brote::class)->findAll();
                break;
            case 'principal':
                $data = $this->registry->getRepository(Principal::class)->findAll();
                break;
            case 'index':
            default:
                $data = null;
        }

        dd($data);
        return json_encode($data);


    }

    private function setupTypeSecondaryNameField(FormInterface $form, ?string $origin)
    {
        if(null === $origin){
            $form->remove('typeSecondary');
        }
        $choices = $this->getOriginNameChoices($origin);
        if (null === $choices) {
            $form->remove('typeSecondary');
            return;
        }

        $form->add('typeSecondary', ChoiceType::class, [
            'label'=>'Página',
            'placeholder'=>'Seleccione donde se agregará esta sección',
            'choices' => $choices,
            'required' => false,
        ]);
    }




}