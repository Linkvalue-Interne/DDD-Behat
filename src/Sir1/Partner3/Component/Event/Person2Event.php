<?php

namespace Sir1\Partner3\Component\Event;

use Sir1\Partner3\Component\Action\AbstractPerson2Action;
use Sir1\Partner3\Component\Entity\Person2;
use Majora\Framework\Event\BroadcastableEvent;

/**
 * Person2 specific event class.
 */
class Person2Event extends BroadcastableEvent
{
    /**
     * @var Person2
     */
    protected $person2;

    /**
     * @var AbstractPerson2Action
     */
    protected $action;

    /**
     * construct.
     *
     * @param Person2               $person2
     * @param AbstractPerson2Action $action
     */
    public function __construct(Person2 $person2, AbstractPerson2Action $action = null)
    {
        $this->person2 = $person2;
        $this->action = $action;
    }

    /**
     * return related.
     *
     * @return Person2
     */
    public function getPerson2()
    {
        return $this->person2;
    }

    /**
     * @see BroadcastableEventInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->getPerson2();
    }

    /**
     * @see BroadcastableEventInterface::getAction()
     */
    public function getAction()
    {
        return $this->action;
    }
}
