<?php

namespace Acme\Lv\Component\Domain;

use Acme\Lv\Component\Entity\Post;

/**
 * Interface for Post domain use cases.
 */
interface PostDomainInterface
{
    /**
     * Create and returns an action for create a Post.
     *
     * @return CreatePostAction
     */
    public function create();

    /**
     * Create and returns an action for update a Post.
     *
     * @param Post $post
     *
     * @return UpdatePostAction
     */
    public function edit(Post $post);

    /**
     * Create and returns an action for delete a Post.
     *
     * @param Post $post
     *
     * @return DeletePostAction
     */
    public function delete(Post $post);
}
