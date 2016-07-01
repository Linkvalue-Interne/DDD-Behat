<?php

namespace Test2\Test2\Bundle\DalBundle\Persistence;

use Test2\Test2\Component\Event\Test2Event;
use Test2\Test2\Component\Event\Test2Events;
use Test2\Test2\Component\Repository\Test2RepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber on all Test2 events for persistence calls.
 */
class Test2PersistenceListener implements EventSubscriberInterface
{
    /**
     * @var Test2RepositoryInterface
     */
    protected $test2Repository;

    /**
     * Construct.
     *
     * @param Test2RepositoryInterface $test2Repository
     */
    public function __construct(Test2RepositoryInterface $test2Repository)
    {
        $this->test2Repository = $test2Repository;
    }

    /**
     * @see EventSubscriberInterface::getSubscribedEvents()
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents()
    {
        return array(
            Test2Events::TEST2_TEST2_CREATED => array('onWriteTest2', -100),
            Test2Events::TEST2_TEST2_EDITED => array('onWriteTest2', -100),
            Test2Events::TEST2_TEST2_DELETED => array('onDeleteTest2', -100),
        );
    }

    /**
     * Test2 writting event handler.
     *
     * @param Test2Event $event
     */
    public function onWriteTest2(Test2Event $event)
    {
        $this->test2Repository->persist(
            $event->getTest2()
        );
    }

    /**
     * Test2 deletion event handler.
     *
     * @param Test2Event $event
     */
    public function onDeleteTest2(Test2Event $event)
    {
        $this->test2Repository->remove(
            $event->getTest2()
        );
    }
}
