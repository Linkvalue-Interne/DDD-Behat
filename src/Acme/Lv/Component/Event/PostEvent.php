<?php

namespace Acme\Lv\Component\Event;

use Acme\Lv\Component\Action\AbstractPostAction;
use Acme\Lv\Component\Entity\Post;
use Majora\Framework\Event\BroadcastableEvent;

/**
 * Post specific event class.
 */
class PostEvent extends BroadcastableEvent
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * @var AbstractPostAction
     */
    protected $action;

    /**
     * construct.
     *
     * @param Post               $post
     * @param AbstractPostAction $action
     */
    public function __construct(Post $post, AbstractPostAction $action = null)
    {
        $this->post = $post;
        $this->action = $action;
    }

    /**
     * return related.
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @see BroadcastableEventInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->getPost();
    }

    /**
     * @see BroadcastableEventInterface::getAction()
     */
    public function getAction()
    {
        return $this->action;
    }
}
