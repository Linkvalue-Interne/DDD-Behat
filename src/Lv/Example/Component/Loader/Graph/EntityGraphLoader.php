<?php

namespace Lv\Example\Component\Loader\Graph;

use Lv\Example\Component\Loader\EntityLoaderInterface;
use Majora\Framework\Loader\Bridge\Graph\AbstractGraphLoader;

/**
 * Entity repository implementation using graph database.
 */
class EntityGraphLoader extends AbstractGraphLoader
    implements EntityLoaderInterface
{
    use Auto\EntityGraphLoaderTrait;
}
