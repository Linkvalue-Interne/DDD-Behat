<?php

namespace Sir1\Partner3\Component\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * Person2 model collection class.
 */
class Person2Collection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return Person2::class;
    }
}
