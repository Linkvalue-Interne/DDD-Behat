<?php

namespace Lv\Example\Component\Action;

use Lv\Example\Component\Entity\Entity;
use Majora\Framework\Domain\Action\AbstractAction;

/**
 * Base class for EntityActions.
 *
 * @property $entity
 */
abstract class AbstractEntityAction extends AbstractAction
{
    /**
     * @var Entity
     */
    protected $entity;

    /**
     * Initialisation function.
     *
     * @param Entity $entity
     */
    public function init(Entity $entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Return related Entity if defined.
     *
     * @return Entity|null $entity
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
