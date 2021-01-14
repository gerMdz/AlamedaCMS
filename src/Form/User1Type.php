<?php

namespace App\Form;

use App\Entity\Roles;
use App\Entity\User;
use App\Repository\RolesRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\JsonType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class User1Type extends AbstractType
{

    private $rolesRepository;

    /**
     * User1Type constructor.
     * @param RolesRepository $rolesRepository
     */
    public function __construct(RolesRepository $rolesRepository)
    {
        $this->rolesRepository = $rolesRepository;
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
            ->add('roles',  ChoiceType::class, [
                'choices' => $rolesChoices,
                'expanded' => true,
                'multiple' => true,
                'label' => 'Roles',
            ])

            ->add('primerNombre')
//            ->add('twitterUsername')
//            ->add('avatarUrl')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
