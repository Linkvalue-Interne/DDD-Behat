<?php

namespace Acme\Lv\Component\Action\Dal\Post;

use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Event\PostEvent;
use Acme\Lv\Component\Event\PostEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Post creation action representation.
 */
class CreateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * Post creation method.
     *
     * @return Post
     */
    public function resolve()
    {
        $this->post = new Post();
        $this->post->deserialize($this->serialize());

        $this->assertEntityIsValid($this->post, array('Post', 'creation'));

        $this->fireEvent(
            PostEvents::ACME_POST_CREATED,
            new PostEvent($this->post, $this)
        );

        return $this->post;
    }
}
