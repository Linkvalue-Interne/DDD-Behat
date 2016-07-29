<?php

namespace Sir1\Partner3\Component\Tests\Action\Dal\Person2;

use Sir1\Partner3\Component\Action\Dal\Person2\CreateAction;
use Sir1\Partner3\Component\Entity\Person2;
use Sir1\Partner3\Component\Event\Person2Event;
use Sir1\Partner3\Component\Event\Person2Events;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Person2 CreateAction throught Dal.
 *
 * @see Sir1\Partner3\Component\Domain\Action\Api\Person2\CreateAction
 */
class CreateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         'incomming data',
     *         'expected_person2'
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
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
        array $incommingData,
        Person2 $expectedPerson2
    ) {
        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Person2::class),
                null,
                array('Person2', 'creation')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                Person2Events::SIR1_PERSON2_CREATED,
                Argument::type(Person2Event::class)
            )
            ->shouldBeCalled()
        ;

        // Action
        $action = new CreateAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedPerson2,
            $action->resolve()
        );
    }
}
