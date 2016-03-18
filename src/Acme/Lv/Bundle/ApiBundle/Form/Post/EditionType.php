<?php

namespace Acme\Lv\Bundle\ApiBundle\Form\Post;

use Acme\Lv\Component\Action\Dal\Post\UpdateAction;
use Acme\Lv\Component\Entity\Post;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type for Post edition use case.
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
                return $this->postDomain->getAction(
                    'update',
                    $form->getConfig()->getOption('entity')
                );
            },
        ));
        $resolver->setRequired('entity');
        $resolver->setAllowedTypes('entity', Post::class);
    }
}
