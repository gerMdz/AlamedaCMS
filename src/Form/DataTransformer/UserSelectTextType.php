<?php

namespace App\Form\DataTransformer;

use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class UserSelectTextType extends AbstractType
{
    /**
     * UserSelectTextType constructor.
     */
    public function __construct(protected UserRepository $userRepository, protected RouterInterface $router)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new EmailToUserTransformer(
            $this->userRepository,
            $options['finder_callback']
        ));
    }

    public function getParent(): ?string
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'invalid_message' => 'Usuario no encontrado',
            'finder_callback' => fn (UserRepository $userRepository, string $email) => $userRepository->findOneBy(['email' => $email]),
            'attr' => [
            ],
        ]);
    }

    public function buildView(FormView $view, FormInterface $form, array $options): void
    {
        $attr = $view->vars['attr'];
        $class = isset($attr['class']) ? $attr['class'].' ' : '';
        $class .= 'js-user-autocomplete';

        $attr['class'] = $class;

        $attr['data-autocomplete-url'] = $this->router->generate('admin_utility_user');
        $view->vars['attr'] = $attr;
    }
}
