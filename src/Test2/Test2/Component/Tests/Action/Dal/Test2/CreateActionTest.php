<?php

namespace Test2\Test2\Component\Tests\Action\Dal\Test2;

use Test2\Test2\Component\Action\Dal\Test2\CreateAction;
use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Event\Test2Event;
use Test2\Test2\Component\Event\Test2Events;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Test2 CreateAction throught Dal.
 *
 * @see Test2\Test2\Component\Domain\Action\Api\Test2\CreateAction
 */
class CreateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         'incomming data',
     *         'expected_test2'
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
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
        array $incommingData,
        Test2 $expectedTest2
    ) {
        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Test2::class),
                null,
                array('Test2', 'creation')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                Test2Events::TEST2_TEST2_CREATED,
                Argument::type(Test2Event::class)
            )
            ->shouldBeCalled()
        ;

        // Action
        $action = new CreateAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedTest2,
            $action->resolve()
        );
    }
}
