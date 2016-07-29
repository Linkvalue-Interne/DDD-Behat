<?php

namespace Lv\Example\Component\Loader\Doctrine;

use Lv\Example\Component\Loader\EntityLoaderInterface;
use Majora\Framework\Loader\Bridge\Doctrine\AbstractDoctrineLoader;

/**
 * Entity repository implementation using graph database.
 */
class EntityDoctrineLoader extends AbstractDoctrineLoader
    implements EntityLoaderInterface
{
    use Auto\EntityDoctrineLoaderTrait;
}
