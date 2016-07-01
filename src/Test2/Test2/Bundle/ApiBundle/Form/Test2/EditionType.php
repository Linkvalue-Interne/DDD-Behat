<?php

namespace Test2\Test2\Bundle\ApiBundle\Form\Test2;

use Test2\Test2\Component\Action\Dal\Test2\UpdateAction;
use Test2\Test2\Component\Entity\Test2;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Test2 edition use case.
 */
class EditionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class' => UpdateAction::class,
            'empty_data' => function (FormInterface $form) {
                return $this->test2Domain->getAction(
                    'update',
                    $form->getConfig()->getOption('entity')
                );
            },
        ));
        $resolver->setRequired('entity');
        $resolver->setAllowedTypes('entity', Test2::class);
    }
}
