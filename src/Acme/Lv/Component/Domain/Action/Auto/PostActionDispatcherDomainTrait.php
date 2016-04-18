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
    public function create(...$arguments)
    {
        return $this->getAction('create', null, ...$arguments)
            ->resolve()
        ;
    }

    /**
     * @see PostDomainInterface::update()
     */
    public function update(Post $post,  ...$arguments)
    {
        return $this->getAction('update', $post, ...$arguments)
            ->resolve()
        ;
    }

    /**
     * @see PostDomainInterface::delete()
     */
    public function delete(Post $post,  ...$arguments)
    {
        return $this->getAction('delete', $post, ...$arguments)
            ->resolve()
        ;
    }
}
