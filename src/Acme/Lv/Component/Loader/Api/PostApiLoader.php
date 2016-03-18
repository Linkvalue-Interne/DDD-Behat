<?php

namespace Acme\Lv\Component\Loader\Api;

use Acme\Lv\Component\Loader\PostLoaderInterface;
use Majora\Framework\Loader\Bridge\Api\AbstractApiLoader;

/**
 * Post repository implementation using graph database.
 */
class PostApiLoader extends AbstractApiLoader
    implements PostLoaderInterface
{
    use Auto\PostApiLoaderTrait;
}
