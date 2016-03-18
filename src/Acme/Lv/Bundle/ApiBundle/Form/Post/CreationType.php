<?php

namespace Acme\Lv\Bundle\ApiBundle\Form\Post;

use Acme\Lv\Component\Action\Dal\Post\CreateAction;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Post creation use case.
 */
class CreationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => CreateAction::class,
            'empty_data' => function (FormInterface $form) {
                return $this->postDomain->getAction('create');
            },
        ));
    }
}
