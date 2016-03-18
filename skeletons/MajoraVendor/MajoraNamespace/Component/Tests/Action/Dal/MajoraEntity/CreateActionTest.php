<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Action\Dal\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity\CreateAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for MajoraEntity CreateAction throught Dal.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Domain\Action\Api\MajoraEntity\CreateAction
 */
class CreateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         'incomming data',
     *         'expected_majora_entity'
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                new MajoraEntity(),
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
        MajoraEntity $expectedMajoraEntity
    ) {
        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(MajoraEntity::class),
                null,
                array('MajoraEntity', 'creation')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_CREATED,
                Argument::type(MajoraEntityEvent::class)
            )
            ->shouldBeCalled()
        ;

        // Action
        $action = new CreateAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedMajoraEntity,
            $action->resolve()
        );
    }
}
