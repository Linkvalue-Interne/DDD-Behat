<?php

namespace Sir\Partner\Component\Loader\Graph;

use Sir\Partner\Component\Loader\PersonLoaderInterface;
use Majora\Framework\Loader\Bridge\Graph\AbstractGraphLoader;

/**
 * Person repository implementation using graph database.
 */
class PersonGraphLoader extends AbstractGraphLoader
    implements PersonLoaderInterface
{
    use Auto\PersonGraphLoaderTrait;
}
