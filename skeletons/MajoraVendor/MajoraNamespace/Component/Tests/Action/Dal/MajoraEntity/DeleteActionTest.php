<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Action\Dal\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity\DeleteAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Unit test class for MajoraEntity DeleteAction throught Dal.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Domain\Action\Dal\MajoraEntity\DeleteAction
 */
class DeleteActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_majora_entity"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'default_case' => array(
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
        MajoraEntity $givenMajoraEntity
    ) {
        $asserter = $this;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_DELETED,
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
        $action = new DeleteAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenMajoraEntity);

        $action->resolve();
    }
}
