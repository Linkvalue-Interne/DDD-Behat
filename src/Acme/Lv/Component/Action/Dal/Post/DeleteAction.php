<?php

namespace Acme\Lv\Component\Action\Dal\Post;

use Acme\Lv\Component\Event\PostEvent;
use Acme\Lv\Component\Event\PostEvents;

/**
 * Post deletion action representation.
 */
class DeleteAction extends AbstractDalAction
{
    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->fireEvent(
            PostEvents::ACME_POST_DELETED,
            new PostEvent($this->post, $this)
        );
    }
}
