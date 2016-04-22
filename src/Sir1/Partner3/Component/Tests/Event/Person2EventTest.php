<?php

namespace Sir1\Partner3\Component\Tests\Event;

use Sir1\Partner3\Component\Action\AbstractPerson2Action;
use Sir1\Partner3\Component\Entity\Person2;
use Sir1\Partner3\Component\Event\Person2Event;

/**
 * Unit test class for Person2 CreateAction throught Dal.
 *
 * @see Sir1\Partner3\Component\Event\Person2Event
 */
class Person2EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests resolve() function.
     */
    public function testAccessors()
    {
        $action = $this->prophesize(AbstractPerson2Action::class)->reveal();

        // Event
        $event = new Person2Event(
            $person2 = new Person2(),
            $action
        );

        // Assertions
        $this->assertSame($person2, $event->getPerson2());
        $this->assertSame($person2, $event->getSubject());
        $this->assertSame($action, $event->getAction());
    }
}
