<?php

namespace Lv\Example\Component\Action\Dal\Entity;

use Lv\Example\Component\Event\EntityEvent;
use Lv\Example\Component\Event\EntityEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Entity edition action representation.
 */
class UpdateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->entity->deserialize($this->serialize());

        $this->assertEntityIsValid($this->entity, array('Entity', 'edition'));

        $this->fireEvent(
            EntityEvents::LV_ENTITY_EDITED,
            new EntityEvent($this->entity, $this)
        );
    }
}
