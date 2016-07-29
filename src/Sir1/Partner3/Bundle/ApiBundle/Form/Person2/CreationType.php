<?php

namespace Sir1\Partner3\Bundle\ApiBundle\Form\Person2;

use Sir1\Partner3\Component\Action\Dal\Person2\CreateAction;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Person2 creation use case.
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
                return $this->person2Domain->getAction('create');
            },
        ));
    }
}
