<?php

namespace Sir1\Partner3\Bundle\ApiBundle\Form\Person2;

use Sir1\Partner3\Component\Action\Dal\Person2\UpdateAction;
use Sir1\Partner3\Component\Entity\Person2;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Person2 edition use case.
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
                return $this->person2Domain->getAction(
                    'update',
                    $form->getConfig()->getOption('entity')
                );
            },
        ));
        $resolver->setRequired('entity');
        $resolver->setAllowedTypes('entity', Person2::class);
    }
}
