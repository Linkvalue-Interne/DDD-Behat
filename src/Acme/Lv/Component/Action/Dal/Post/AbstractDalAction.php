<?php

namespace Acme\Lv\Component\Action\Dal\Post;

use Acme\Lv\Component\Action\AbstractPostAction;
use Majora\Framework\Domain\Action\Dal\DalActionTrait;

/**
 * Base class for Post Dal centric actions.
 *
 * @property $post
 */
abstract class AbstractDalAction extends AbstractPostAction
{
    use DalActionTrait;
}
