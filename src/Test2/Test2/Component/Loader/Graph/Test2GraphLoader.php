<?php

namespace Test2\Test2\Component\Loader\Graph;

use Test2\Test2\Component\Loader\Test2LoaderInterface;
use Majora\Framework\Loader\Bridge\Graph\AbstractGraphLoader;

/**
 * Test2 repository implementation using graph database.
 */
class Test2GraphLoader extends AbstractGraphLoader
    implements Test2LoaderInterface
{
    use Auto\Test2GraphLoaderTrait;
}
