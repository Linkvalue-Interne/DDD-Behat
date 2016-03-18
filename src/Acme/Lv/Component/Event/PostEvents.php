<?php

namespace Acme\Lv\Component\Event;

/**
 * Post event reference class.
 */
final class PostEvents
{
    /**
     * event fired when a post is created.
     */
    const ACME_POST_CREATED = 'acme.post.created';

    /**
     * event fired when a post is updated.
     */
    const ACME_POST_EDITED = 'acme.post.edited';

    /**
     * event fired when a post is deleted.
     */
    const ACME_POST_DELETED = 'acme.post.deleted';
}
