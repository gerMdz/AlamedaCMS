<?php

namespace App\Form;

use App\Entity\User;
use App\Repository\RolesRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{
    /**
     * User1Type constructor.
     */
    public function __construct(private readonly RolesRepository $rolesRepository)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $rolesChoices = [];
        $roles = $this->rolesRepository->findAll();
        foreach ($roles as $rol) {
            $rolesChoices[$rol->getNombre()] = $rol->__toString();
        }

        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => $rolesChoices,
                'expanded' => true,
                'multiple' => true,
                'label' => 'Roles',
            ])

            ->add('primerNombre')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
