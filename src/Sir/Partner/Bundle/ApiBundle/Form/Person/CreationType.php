<?php

namespace Sir\Partner\Bundle\ApiBundle\Form\Person;

use Sir\Partner\Component\Action\Dal\Person\CreateAction;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Person creation use case.
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
                return $this->personDomain->getAction('create');
            },
        ));
    }
}
