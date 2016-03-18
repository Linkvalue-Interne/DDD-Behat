<?php

namespace Acme\Lv\Component\Domain\Action;

use Acme\Lv\Component\Domain\PostDomainInterface;
use Majora\Framework\Domain\ActionDispatcherDomain;

/**
 * Post domain use cases class.
 *
 * Auto generated methods :
 *
 * @method create()
 * @method edit(Post $post)
 * @method delete(Post $post)
 */
class PostActionDispatcherDomain extends ActionDispatcherDomain
    implements PostDomainInterface
{
    use Auto\PostActionDispatcherDomainTrait;
}
