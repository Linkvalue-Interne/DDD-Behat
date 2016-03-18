<?php

namespace Acme\Lv\Component\Domain\Action\Auto;

use Acme\Lv\Component\Entity\Post;

/**
 * Post domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @method resolve()
 *
 * @codeCoverageIgnore
 */
trait PostActionDispatcherDomainTrait
{
    /**
     * @see PostDomainInterface::create()
     */
    public function create()
    {
        return $this->resolve('create');
    }

    /**
     * @see PostDomainInterface::edit()
     */
    public function edit(Post $post)
    {
        return $this->resolve('edit', $post);
    }

    /**
     * @see PostDomainInterface::delete()
     */
    public function delete(Post $post)
    {
        return $this->resolve('delete', $post);
    }
}
