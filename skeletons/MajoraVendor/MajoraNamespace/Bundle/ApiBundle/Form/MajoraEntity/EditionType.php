<?php

namespace MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Form\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity\UpdateAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for MajoraEntity edition use case.
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
                return $this->majoraEntityDomain->getAction(
                    'update',
                    $form->getConfig()->getOption('entity')
                );
            },
        ));
        $resolver->setRequired('entity');
        $resolver->setAllowedTypes('entity', MajoraEntity::class);
    }
}
