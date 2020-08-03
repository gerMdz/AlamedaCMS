<?php


namespace App\Form\TypeExtension;


use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;


class TextareaSizeExtension implements FormTypeExtensionInterface
{

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

    }

    /**
     * @inheritDoc
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {

        $view->vars['attr']['rows'] = $options['rows'];
    }

    /**
     * @inheritDoc
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'rows' => 5
        ]);

    }

    /**
     * @inheritDoc
     */
    public function getExtendedType()
    {
        return TextareaType::class;
    }



    public static function getExtendedTypes(): iterable
    {
        return [TextareaType::class];
    }

    public function __call($name, $arguments)
    {

    }
}