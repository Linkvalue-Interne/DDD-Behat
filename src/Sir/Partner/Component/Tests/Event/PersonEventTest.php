<?php

namespace Sir\Partner\Component\Tests\Event;

use Sir\Partner\Component\Action\AbstractPersonAction;
use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Event\PersonEvent;

/**
 * Unit test class for Person CreateAction throught Dal.
 *
 * @see Sir\Partner\Component\Event\PersonEvent
 */
class PersonEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests resolve() function.
     */
    public function testAccessors()
    {
        $action = $this->prophesize(AbstractPersonAction::class)->reveal();

        // Event
        $event = new PersonEvent(
            $person = new Person(),
            $action
        );

        // Assertions
        $this->assertSame($person, $event->getPerson());
        $this->assertSame($person, $event->getSubject());
        $this->assertSame($action, $event->getAction());
    }
}
