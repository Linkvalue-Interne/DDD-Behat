<?php

namespace Sir\Partner\Component\Tests\Action\Dal\Person;

use Sir\Partner\Component\Action\Dal\Person\UpdateAction;
use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Event\PersonEvent;
use Sir\Partner\Component\Event\PersonEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Person DeleteAction throught Dal.
 *
 * @see Sir\Partner\Component\Domain\Action\Dal\Person\UpdateAction
 */
class UpdateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_update_data",
     *         "given_person"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                (new Person())->setId(42),
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
        Person $givenPerson
    ) {
        $asserter = $this;

        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Person::class),
                null,
                array('Person', 'edition')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                PersonEvents::SIR_PERSON_EDITED,
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
        $action = new UpdateAction();
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenPerson);

        $action->resolve();
    }
}
