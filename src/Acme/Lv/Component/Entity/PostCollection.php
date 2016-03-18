<?php

namespace Acme\Lv\Component\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * Post model collection class.
 */
class PostCollection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return Post::class;
    }
}
