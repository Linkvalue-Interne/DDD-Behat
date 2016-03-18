<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Event;

use MajoraVendor\MajoraNamespace\Component\Action\AbstractMajoraEntityAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent;

/**
 * Unit test class for MajoraEntity CreateAction throught Dal.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent
 */
class MajoraEntityEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests resolve() function.
     */
    public function testAccessors()
    {
        $action = $this->prophesize(AbstractMajoraEntityAction::class)->reveal();

        // Event
        $event = new MajoraEntityEvent(
            $majoraEntity = new MajoraEntity(),
            $action
        );

        // Assertions
        $this->assertSame($majoraEntity, $event->getMajoraEntity());
        $this->assertSame($majoraEntity, $event->getSubject());
        $this->assertSame($action, $event->getAction());
    }
}
