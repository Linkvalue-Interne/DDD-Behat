<?php

namespace Sir\Partner\Bundle\ApiBundle\Form\Person;

use Sir\Partner\Component\Action\Dal\Person\UpdateAction;
use Sir\Partner\Component\Entity\Person;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Person edition use case.
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
                return $this->personDomain->getAction(
                    'update',
                    $form->getConfig()->getOption('entity')
                );
            },
        ));
        $resolver->setRequired('entity');
        $resolver->setAllowedTypes('entity', Person::class);
    }
}
