<?php

namespace Lv\Example\Component\Tests\Event;

use Lv\Example\Component\Action\AbstractEntityAction;
use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Event\EntityEvent;

/**
 * Unit test class for Entity CreateAction throught Dal.
 *
 * @see Lv\Example\Component\Event\EntityEvent
 */
class EntityEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests resolve() function.
     */
    public function testAccessors()
    {
        $action = $this->prophesize(AbstractEntityAction::class)->reveal();

        // Event
        $event = new EntityEvent(
            $entity = new Entity(),
            $action
        );

        // Assertions
        $this->assertSame($entity, $event->getEntity());
        $this->assertSame($entity, $event->getSubject());
        $this->assertSame($action, $event->getAction());
    }
}
