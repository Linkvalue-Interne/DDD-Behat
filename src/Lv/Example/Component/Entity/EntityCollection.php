<?php

namespace Lv\Example\Component\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * Entity model collection class.
 */
class EntityCollection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return Entity::class;
    }
}
