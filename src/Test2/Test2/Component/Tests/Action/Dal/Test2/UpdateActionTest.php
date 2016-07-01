<?php

namespace Test2\Test2\Component\Tests\Action\Dal\Test2;

use Test2\Test2\Component\Action\Dal\Test2\UpdateAction;
use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Event\Test2Event;
use Test2\Test2\Component\Event\Test2Events;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Test2 DeleteAction throught Dal.
 *
 * @see Test2\Test2\Component\Domain\Action\Dal\Test2\UpdateAction
 */
class UpdateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_update_data",
     *         "given_test2"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                (new Test2())->setId(42),
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
        Test2 $givenTest2
    ) {
        $asserter = $this;

        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Test2::class),
                null,
                array('Test2', 'edition')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                Test2Events::TEST2_TEST2_EDITED,
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
        $action = new UpdateAction();
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenTest2);

        $action->resolve();
    }
}
