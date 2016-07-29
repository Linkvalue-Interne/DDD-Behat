<?php

namespace Lv\Example\Component\Action\Dal\Entity;

use Lv\Example\Component\Event\EntityEvent;
use Lv\Example\Component\Event\EntityEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Entity deletion action representation.
 */
class DeleteAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->fireEvent(
            EntityEvents::LV_ENTITY_DELETED,
            new EntityEvent($this->entity, $this)
        );
    }
}
