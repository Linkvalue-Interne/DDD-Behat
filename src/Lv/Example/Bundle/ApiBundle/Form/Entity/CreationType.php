<?php

namespace Lv\Example\Bundle\ApiBundle\Form\Entity;

use Lv\Example\Component\Action\Dal\Entity\CreateAction;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Entity creation use case.
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
                return $this->entityDomain->getAction('create');
            },
        ));
    }
}
