<?php

namespace MajoraVendor\MajoraNamespace\Component\Entity;

use Majora\Framework\Model\EntityCollection;

/**
 * MajoraEntity model collection class.
 */
class MajoraEntityCollection extends EntityCollection
{
    /**
     * @see Majora\Framework\Model\EntityCollection::getEntityClass()
     */
    protected function getEntityClass()
    {
        return MajoraEntity::class;
    }
}
