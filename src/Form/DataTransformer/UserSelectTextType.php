<?php


namespace App\Form\DataTransformer;


use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class UserSelectTextType extends AbstractType
{

    protected $userRepository;
    protected $router;

    /**
     * UserSelectTextType constructor.
     * @param UserRepository $userRepository
     * @param RouterInterface $router
     */
    public function __construct(UserRepository $userRepository, RouterInterface $router)
    {
        $this->userRepository = $userRepository;
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer(new EmailToUserTransformer(
            $this->userRepository,
            $options['finder_callback']
        ));
    }

    public function getParent()
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
           'invalid_message'=>'Usuario no encontrado',
            'finder_callback' => function(UserRepository $userRepository, string $email) {
                return $userRepository->findOneBy(['email' => $email]);
            },
            'attr'=>[
                'class'=>'js-user-autocomplete',
                'data-autocomplete-url'=>$this->router->generate('admin_utility_user')
            ]
        ]);
    }

}