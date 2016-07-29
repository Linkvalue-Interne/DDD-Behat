<?php

namespace Lv\Example\Component\Loader\Api;

use Lv\Example\Component\Loader\EntityLoaderInterface;
use Majora\Framework\Loader\Bridge\Api\AbstractApiLoader;

/**
 * Entity repository implementation using graph database.
 */
class EntityApiLoader extends AbstractApiLoader
    implements EntityLoaderInterface
{
    use Auto\EntityApiLoaderTrait;
}
