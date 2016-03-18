<?php

namespace Acme\Lv\Component\Loader\Graph;

use Acme\Lv\Component\Loader\PostLoaderInterface;
use Majora\Framework\Loader\Bridge\Graph\AbstractGraphLoader;

/**
 * Post repository implementation using graph database.
 */
class PostGraphLoader extends AbstractGraphLoader
    implements PostLoaderInterface
{
    use Auto\PostGraphLoaderTrait;
}
