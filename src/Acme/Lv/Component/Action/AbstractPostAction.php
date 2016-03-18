<?php

namespace Acme\Lv\Component\Action;

use Acme\Lv\Component\Entity\Post;
use Majora\Framework\Domain\Action\AbstractAction;

/**
 * Base class for PostActions.
 *
 * @property $post
 */
abstract class AbstractPostAction extends AbstractAction
{
    /**
     * @var Post
     */
    protected $post;

    /**
     * Initialisation function.
     *
     * @param Post $post
     */
    public function init(Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Return related Post if defined.
     *
     * @return Post|null $post
     */
    public function getPost()
    {
        return $this->post;
    }
}
