<?php

namespace Lv\Example\Component\Tests\Action\Dal\Entity;

use Lv\Example\Component\Action\Dal\Entity\CreateAction;
use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Event\EntityEvent;
use Lv\Example\Component\Event\EntityEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Entity CreateAction throught Dal.
 *
 * @see Lv\Example\Component\Domain\Action\Api\Entity\CreateAction
 */
class CreateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         'incomming data',
     *         'expected_entity'
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
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
        array $incommingData,
        Entity $expectedEntity
    ) {
        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Entity::class),
                null,
                array('Entity', 'creation')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                EntityEvents::LV_ENTITY_CREATED,
                Argument::type(EntityEvent::class)
            )
            ->shouldBeCalled()
        ;

        // Action
        $action = new CreateAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedEntity,
            $action->resolve()
        );
    }
}
