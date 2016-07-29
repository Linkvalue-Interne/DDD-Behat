<?php

namespace Lv\Example\Bundle\ApiBundle\Form\Entity;

use Lv\Example\Component\Action\Dal\Entity\UpdateAction;
use Lv\Example\Component\Entity\Entity;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Entity edition use case.
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
                return $this->entityDomain->getAction(
                    'update',
                    $form->getConfig()->getOption('entity')
                );
            },
        ));
        $resolver->setRequired('entity');
        $resolver->setAllowedTypes('entity', Entity::class);
    }
}
