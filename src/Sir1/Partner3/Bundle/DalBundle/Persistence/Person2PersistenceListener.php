<?php

namespace Sir1\Partner3\Bundle\DalBundle\Persistence;

use Sir1\Partner3\Component\Event\Person2Event;
use Sir1\Partner3\Component\Event\Person2Events;
use Sir1\Partner3\Component\Repository\Person2RepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber on all Person2 events for persistence calls.
 */
class Person2PersistenceListener implements EventSubscriberInterface
{
    /**
     * @var Person2RepositoryInterface
     */
    protected $person2Repository;

    /**
     * Construct.
     *
     * @param Person2RepositoryInterface $person2Repository
     */
    public function __construct(Person2RepositoryInterface $person2Repository)
    {
        $this->person2Repository = $person2Repository;
    }

    /**
     * @see EventSubscriberInterface::getSubscribedEvents()
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents()
    {
        return array(
            Person2Events::SIR1_PERSON2_CREATED => array('onWritePerson2', -100),
            Person2Events::SIR1_PERSON2_EDITED => array('onWritePerson2', -100),
            Person2Events::SIR1_PERSON2_DELETED => array('onDeletePerson2', -100),
        );
    }

    /**
     * Person2 writting event handler.
     *
     * @param Person2Event $event
     */
    public function onWritePerson2(Person2Event $event)
    {
        $this->person2Repository->persist(
            $event->getPerson2()
        );
    }

    /**
     * Person2 deletion event handler.
     *
     * @param Person2Event $event
     */
    public function onDeletePerson2(Person2Event $event)
    {
        $this->person2Repository->remove(
            $event->getPerson2()
        );
    }
}
