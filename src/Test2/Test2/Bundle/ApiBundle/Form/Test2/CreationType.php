<?php

namespace Test2\Test2\Bundle\ApiBundle\Form\Test2;

use Test2\Test2\Component\Action\Dal\Test2\CreateAction;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Test2 creation use case.
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
                return $this->test2Domain->getAction('create');
            },
        ));
    }
}
