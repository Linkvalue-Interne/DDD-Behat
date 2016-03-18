<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Action\Dal\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity\UpdateAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for MajoraEntity DeleteAction throught Dal.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Domain\Action\Dal\MajoraEntity\UpdateAction
 */
class UpdateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_update_data",
     *         "given_majora_entity"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                (new MajoraEntity())->setId(42),
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
        MajoraEntity $givenMajoraEntity
    ) {
        $asserter = $this;

        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(MajoraEntity::class),
                null,
                array('MajoraEntity', 'edition')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_EDITED,
                Argument::type(MajoraEntityEvent::class)
            )
            ->will(function ($args) use ($asserter, $givenMajoraEntity) {
                $asserter->assertEquals(
                    $givenMajoraEntity,
                    $args[1]->getMajoraEntity()
                );
            })
            ->shouldBeCalled()
        ;

        // Action
        $action = new UpdateAction();
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenMajoraEntity);

        $action->resolve();
    }
}
