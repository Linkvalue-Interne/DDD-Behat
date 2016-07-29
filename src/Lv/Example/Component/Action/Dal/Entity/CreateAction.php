<?php

namespace Lv\Example\Component\Action\Dal\Entity;

use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Event\EntityEvent;
use Lv\Example\Component\Event\EntityEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Entity creation action representation.
 */
class CreateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * Entity creation method.
     *
     * @return Entity
     */
    public function resolve()
    {
        $this->entity = new Entity();
        $this->entity->deserialize($this->serialize());

        $this->assertEntityIsValid($this->entity, array('Entity', 'creation'));

        $this->fireEvent(
            EntityEvents::LV_ENTITY_CREATED,
            new EntityEvent($this->entity, $this)
        );

        return $this->entity;
    }
}
