<?php

namespace Sir\Partner\Component\Event;

use Sir\Partner\Component\Action\AbstractPersonAction;
use Sir\Partner\Component\Entity\Person;
use Majora\Framework\Event\BroadcastableEvent;

/**
 * Person specific event class.
 */
class PersonEvent extends BroadcastableEvent
{
    /**
     * @var Person
     */
    protected $person;

    /**
     * @var AbstractPersonAction
     */
    protected $action;

    /**
     * construct.
     *
     * @param Person               $person
     * @param AbstractPersonAction $action
     */
    public function __construct(Person $person, AbstractPersonAction $action = null)
    {
        $this->person = $person;
        $this->action = $action;
    }

    /**
     * return related.
     *
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @see BroadcastableEventInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->getPerson();
    }

    /**
     * @see BroadcastableEventInterface::getAction()
     */
    public function getAction()
    {
        return $this->action;
    }
}
