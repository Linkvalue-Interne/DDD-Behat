<?php

namespace Test2\Test2\Component\Event;

use Test2\Test2\Component\Action\AbstractTest2Action;
use Test2\Test2\Component\Entity\Test2;
use Majora\Framework\Event\BroadcastableEvent;

/**
 * Test2 specific event class.
 */
class Test2Event extends BroadcastableEvent
{
    /**
     * @var Test2
     */
    protected $test2;

    /**
     * @var AbstractTest2Action
     */
    protected $action;

    /**
     * construct.
     *
     * @param Test2               $test2
     * @param AbstractTest2Action $action
     */
    public function __construct(Test2 $test2, AbstractTest2Action $action = null)
    {
        $this->test2 = $test2;
        $this->action = $action;
    }

    /**
     * return related.
     *
     * @return Test2
     */
    public function getTest2()
    {
        return $this->test2;
    }

    /**
     * @see BroadcastableEventInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->getTest2();
    }

    /**
     * @see BroadcastableEventInterface::getAction()
     */
    public function getAction()
    {
        return $this->action;
    }
}
