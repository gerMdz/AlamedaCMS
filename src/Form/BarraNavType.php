<?php

namespace App\Form;

use App\Entity\BarraNav;
use App\Entity\ModelTemplate;
use App\Entity\User;
use App\Repository\ModelTemplateRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class BarraNavType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('identifier')
            ->add('content',
                CKEditorType::class,
                [
                    'required' => false,
                    'config' => [
                        'uiColor' => '#ffffff',
//                    'toolbar' => 'full',
                        'language' => 'es',
                    ],
                    'label_attr' => [
                        'class' => 'text-primary',
                    ],
                    'help' => 'Contenido de la entrada, se muestra en pantalla',
                    'attr' => [
                        'required' => false,
                        'rows' => 10,
//                    'class' => 'form-control',
                    ],
                ]
            )
//            ->add('imageFilename')
            ->add('description')
            ->add('isIndex', CheckboxType::class, [
                    'required' => false,
                    'label' => 'Es parte del index',
                    'label_attr' => ['class' => 'checkbox-custom text-dark'],
                    'attr' => [
                        'class' => 'form-check-input ',
                    ],
                ]
            )
//            ->add('createdAt')
//            ->add('updatedAt')
            ->add('cssClass')
            ->add('cssStyle')
            ->add('author',
                EntityType::class,
                [
                    'class' => User::class,
                    'choice_label' => fn(User $user) => sprintf('(%s) %s', $user->getPrimerNombre(), $user->getEmail()),
                    'placeholder' => 'Seleccione Autor',
                    'invalid_message' => 'Por favor ingrese un autor',
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                ]
            )
            ->add('modelTemplate',
                EntityType::class,
                [
                    'class' => ModelTemplate::class,
                    'query_builder' => fn(ModelTemplateRepository $er) => $er->findByTypeSection(),
                    'help' => 'Opcional, llama a un template específico, debe estar en sections creado',
                    'required' => false,
                    'attr' => [
                        'class' => 'select2-enable',
                    ],
                ]
            )
            ->add(
                'imageFile',
                FileType::class,
                [
                    'mapped' => false,
                    'required' => false,
                    'label' => 'Imagen',
                    'constraints' => [
                        new Image(
                            [
                                'maxSize' => '2M',
                                'maxSizeMessage' => 'La imagen no debe superar los 2MB',
                                'mimeTypesMessage' => 'El archivo no es considerada una imagen',
                            ]
                        ),
                    ],

                    'attr' => [
                        'placeholder' => 'Ingrese una imagen para esta entrada',
                    ],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BarraNav::class,
        ]);
    }
}
