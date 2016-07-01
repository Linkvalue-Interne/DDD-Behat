<?php

namespace Test2\Test2\Component\Tests\Action\Dal\Test2;

use Test2\Test2\Component\Action\Dal\Test2\DeleteAction;
use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Event\Test2Event;
use Test2\Test2\Component\Event\Test2Events;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Unit test class for Test2 DeleteAction throught Dal.
 *
 * @see Test2\Test2\Component\Domain\Action\Dal\Test2\DeleteAction
 */
class DeleteActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_test2"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'default_case' => array(
                new Test2(),
            ),
        );
    }

    /**
     * Tests resolve() function.
     *
     * @dataProvider resolvingCasesProvider
     */
    public function testResolve(
        Test2 $givenTest2
    ) {
        $asserter = $this;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                Test2Events::TEST2_TEST2_DELETED,
                Argument::type(Test2Event::class)
            )
            ->will(function ($args) use ($asserter, $givenTest2) {
                $asserter->assertEquals(
                    $givenTest2,
                    $args[1]->getTest2()
                );
            })
            ->shouldBeCalled()
        ;

        // Action
        $action = new DeleteAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenTest2);

        $action->resolve();
    }
}
