<?php

namespace MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Form\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity\CreateAction;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for MajoraEntity creation use case.
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
                return $this->majoraEntityDomain->getAction('create');
            },
        ));
    }
}
