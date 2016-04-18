<?php

namespace Acme\Lv\Component\Action\Dal\Post;

use Acme\Lv\Component\Event\PostEvent;
use Acme\Lv\Component\Event\PostEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Post edition action representation.
 */
class UpdateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->post->deserialize($this->serialize());

        $this->assertEntityIsValid($this->post, array('Post', 'edition'));

        $this->fireEvent(
            PostEvents::ACME_POST_EDITED,
            new PostEvent($this->post, $this)
        );
    }
}
