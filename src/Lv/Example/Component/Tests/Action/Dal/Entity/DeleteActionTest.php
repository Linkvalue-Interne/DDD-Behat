<?php

namespace Lv\Example\Component\Tests\Action\Dal\Entity;

use Lv\Example\Component\Action\Dal\Entity\DeleteAction;
use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Event\EntityEvent;
use Lv\Example\Component\Event\EntityEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Unit test class for Entity DeleteAction throught Dal.
 *
 * @see Lv\Example\Component\Domain\Action\Dal\Entity\DeleteAction
 */
class DeleteActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_entity"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'default_case' => array(
                new Entity(),
            ),
        );
    }

    /**
     * Tests resolve() function.
     *
     * @dataProvider resolvingCasesProvider
     */
    public function testResolve(
        Entity $givenEntity
    ) {
        $asserter = $this;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                EntityEvents::LV_ENTITY_DELETED,
                Argument::type(EntityEvent::class)
            )
            ->will(function ($args) use ($asserter, $givenEntity) {
                $asserter->assertEquals(
                    $givenEntity,
                    $args[1]->getEntity()
                );
            })
            ->shouldBeCalled()
        ;

        // Action
        $action = new DeleteAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenEntity);

        $action->resolve();
    }
}
