<?php

namespace Sir\Partner\Component\Tests\Action\Dal\Person;

use Sir\Partner\Component\Action\Dal\Person\CreateAction;
use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Event\PersonEvent;
use Sir\Partner\Component\Event\PersonEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Person CreateAction throught Dal.
 *
 * @see Sir\Partner\Component\Domain\Action\Api\Person\CreateAction
 */
class CreateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         'incomming data',
     *         'expected_person'
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
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
        array $incommingData,
        Person $expectedPerson
    ) {
        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Person::class),
                null,
                array('Person', 'creation')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                PersonEvents::SIR_PERSON_CREATED,
                Argument::type(PersonEvent::class)
            )
            ->shouldBeCalled()
        ;

        // Action
        $action = new CreateAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedPerson,
            $action->resolve()
        );
    }
}
