<?php

namespace Test2\Test2\Component\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * Test2 model collection class.
 */
class Test2Collection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return Test2::class;
    }
}
