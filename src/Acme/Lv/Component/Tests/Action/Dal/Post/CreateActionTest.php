<?php

namespace Acme\Lv\Component\Tests\Action\Dal\Post;

use Acme\Lv\Component\Action\Dal\Post\CreateAction;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Event\PostEvent;
use Acme\Lv\Component\Event\PostEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Post CreateAction throught Dal.
 *
 * @see Acme\Lv\Component\Domain\Action\Api\Post\CreateAction
 */
class CreateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         'incomming data',
     *         'expected_post'
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                new Post(),
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
        Post $expectedPost
    ) {
        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Post::class),
                null,
                array('Post', 'creation')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                PostEvents::ACME_POST_CREATED,
                Argument::type(PostEvent::class)
            )
            ->shouldBeCalled()
        ;

        // Action
        $action = new CreateAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedPost,
            $action->resolve()
        );
    }
}
