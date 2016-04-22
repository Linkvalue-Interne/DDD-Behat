<?php

namespace Sir\Partner\Component\Loader\Api;

use Sir\Partner\Component\Loader\PersonLoaderInterface;
use Majora\Framework\Loader\Bridge\Api\AbstractApiLoader;

/**
 * Person repository implementation using graph database.
 */
class PersonApiLoader extends AbstractApiLoader
    implements PersonLoaderInterface
{
    use Auto\PersonApiLoaderTrait;
}
