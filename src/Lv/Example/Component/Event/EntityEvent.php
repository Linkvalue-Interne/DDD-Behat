<?php

namespace Lv\Example\Component\Event;

use Lv\Example\Component\Action\AbstractEntityAction;
use Lv\Example\Component\Entity\Entity;
use Majora\Framework\Event\BroadcastableEvent;

/**
 * Entity specific event class.
 */
class EntityEvent extends BroadcastableEvent
{
    /**
     * @var Entity
     */
    protected $entity;

    /**
     * @var AbstractEntityAction
     */
    protected $action;

    /**
     * construct.
     *
     * @param Entity               $entity
     * @param AbstractEntityAction $action
     */
    public function __construct(Entity $entity, AbstractEntityAction $action = null)
    {
        $this->entity = $entity;
        $this->action = $action;
    }

    /**
     * return related.
     *
     * @return Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @see BroadcastableEventInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->getEntity();
    }

    /**
     * @see BroadcastableEventInterface::getAction()
     */
    public function getAction()
    {
        return $this->action;
    }
}
