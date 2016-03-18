<?php

namespace Acme\Lv\Component\Tests\Action\Dal\Post;

use Acme\Lv\Component\Action\Dal\Post\DeleteAction;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Event\PostEvent;
use Acme\Lv\Component\Event\PostEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Unit test class for Post DeleteAction throught Dal.
 *
 * @see Acme\Lv\Component\Domain\Action\Dal\Post\DeleteAction
 */
class DeleteActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_post"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'default_case' => array(
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
        Post $givenPost
    ) {
        $asserter = $this;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                PostEvents::ACME_POST_DELETED,
                Argument::type(PostEvent::class)
            )
            ->will(function ($args) use ($asserter, $givenPost) {
                $asserter->assertEquals(
                    $givenPost,
                    $args[1]->getPost()
                );
            })
            ->shouldBeCalled()
        ;

        // Action
        $action = new DeleteAction();
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenPost);

        $action->resolve();
    }
}
