<?php

namespace Acme\Lv\Component\Tests\Action\Dal\Post;

use Acme\Lv\Component\Action\Dal\Post\UpdateAction;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Event\PostEvent;
use Acme\Lv\Component\Event\PostEvents;
use Prophecy\Argument;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Unit test class for Post DeleteAction throught Dal.
 *
 * @see Acme\Lv\Component\Domain\Action\Dal\Post\UpdateAction
 */
class UpdateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         "given_update_data",
     *         "given_post"
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                (new Post())->setId(42),
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
        Post $givenPost
    ) {
        $asserter = $this;

        // Validator
        $validator = $this->prophesize(ValidatorInterface::class);
        $validator
            ->validate(
                Argument::type(Post::class),
                null,
                array('Post', 'edition')
            )
            ->shouldBeCalled()
        ;

        // Event dispatcher
        $eventDispatcher = $this->prophesize(EventDispatcherInterface::class);
        $eventDispatcher
            ->dispatch(
                PostEvents::ACME_POST_EDITED,
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
        $action = new UpdateAction();
        $action->setValidator($validator->reveal());
        $action->deserialize($incommingData);
        $action->setEventDispatcher($eventDispatcher->reveal());
        $action->init($givenPost);

        $action->resolve();
    }
}
