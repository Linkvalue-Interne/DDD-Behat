<?php

namespace Test2\Test2\Component\Tests\Event;

use Test2\Test2\Component\Action\AbstractTest2Action;
use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Event\Test2Event;

/**
 * Unit test class for Test2 CreateAction throught Dal.
 *
 * @see Test2\Test2\Component\Event\Test2Event
 */
class Test2EventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests resolve() function.
     */
    public function testAccessors()
    {
        $action = $this->prophesize(AbstractTest2Action::class)->reveal();

        // Event
        $event = new Test2Event(
            $test2 = new Test2(),
            $action
        );

        // Assertions
        $this->assertSame($test2, $event->getTest2());
        $this->assertSame($test2, $event->getSubject());
        $this->assertSame($action, $event->getAction());
    }
}
