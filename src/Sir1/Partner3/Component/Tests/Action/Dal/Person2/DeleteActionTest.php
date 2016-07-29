<?php

namespace Sir1\Partner3\Component\Tests\Action\Dal\Person2;

use Sir1\Partner3\Component\Action\Dal\Person2\DeleteAction;
use Sir1\Partner3\Component\Entity\Person2;
use Sir1\Partner3\Component\Event\Person2Event;
use Sir1\Partner3\Component\Event\Person2Events;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Unit test class for Person2 DeleteAction throught Dal.
 *
 * @see Sir1\Partner3\Component\Domain\Action\Dal\Person2\DeleteAction
 */
class DeleteActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_person2"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'default_case' => array(
                new Person2(),
            ),
        );
    }

    /**
     * Tests resolve() function.
     *
     * @dataProvider resolvingCasesProvider
     */
    public function testResolve(
        Person2 $givenPerson2
    ) {
        $asserter = $this;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                Person2Events::SIR1_PERSON2_DELETED,
                Argument::type(Person2Event::class)
            )
            ->will(function ($args) use ($asserter, $givenPerson2) {
                $asserter->assertEquals(
                    $givenPerson2,
                    $args[1]->getPerson2()
                );
            })
            ->shouldBeCalled()
        ;

        // Action
        $action = new DeleteAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenPerson2);

        $action->resolve();
    }
}
