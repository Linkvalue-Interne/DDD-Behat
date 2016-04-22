<?php

namespace Sir\Partner\Component\Tests\Action\Dal\Person;

use Sir\Partner\Component\Action\Dal\Person\DeleteAction;
use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Event\PersonEvent;
use Sir\Partner\Component\Event\PersonEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Unit test class for Person DeleteAction throught Dal.
 *
 * @see Sir\Partner\Component\Domain\Action\Dal\Person\DeleteAction
 */
class DeleteActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_person"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'default_case' => array(
                new Person(),
            ),
        );
    }

    /**
     * Tests resolve() function.
     *
     * @dataProvider resolvingCasesProvider
     */
    public function testResolve(
        Person $givenPerson
    ) {
        $asserter = $this;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                PersonEvents::SIR_PERSON_DELETED,
                Argument::type(PersonEvent::class)
            )
            ->will(function ($args) use ($asserter, $givenPerson) {
                $asserter->assertEquals(
                    $givenPerson,
                    $args[1]->getPerson()
                );
            })
            ->shouldBeCalled()
        ;

        // Action
        $action = new DeleteAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenPerson);

        $action->resolve();
    }
}
