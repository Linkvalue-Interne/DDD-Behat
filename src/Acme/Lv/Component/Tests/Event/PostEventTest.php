<?php

namespace Acme\Lv\Component\Tests\Event;

use Acme\Lv\Component\Action\AbstractPostAction;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Event\PostEvent;

/**
 * Unit test class for Post CreateAction throught Dal.
 *
 * @see Acme\Lv\Component\Event\PostEvent
 */
class PostEventTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests resolve() function.
     */
    public function testAccessors()
    {
        $action = $this->prophesize(AbstractPostAction::class)->reveal();

        // Event
        $event = new PostEvent(
            $post = new Post(),
            $action
        );

        // Assertions
        $this->assertSame($post, $event->getPost());
        $this->assertSame($post, $event->getSubject());
        $this->assertSame($action, $event->getAction());
    }
}
