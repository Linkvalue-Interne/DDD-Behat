<?php

namespace Sir\Partner\Component\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * Person model collection class.
 */
class PersonCollection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return Person::class;
    }
}
