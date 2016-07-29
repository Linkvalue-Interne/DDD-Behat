<?php

namespace Lv\Example\Component\Tests\Action\Dal\Entity;

use Lv\Example\Component\Action\Dal\Entity\UpdateAction;
use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Event\EntityEvent;
use Lv\Example\Component\Event\EntityEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Entity DeleteAction throught Dal.
 *
 * @see Lv\Example\Component\Domain\Action\Dal\Entity\UpdateAction
 */
class UpdateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_update_data",
     *         "given_entity"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                (new Entity())->setId(42),
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
        Entity $givenEntity
    ) {
        $asserter = $this;

        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Entity::class),
                null,
                array('Entity', 'edition')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                EntityEvents::LV_ENTITY_EDITED,
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
        $action = new UpdateAction();
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenEntity);

        $action->resolve();
    }
}
