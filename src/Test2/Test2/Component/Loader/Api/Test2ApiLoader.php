<?php

namespace Test2\Test2\Component\Loader\Api;

use Test2\Test2\Component\Loader\Test2LoaderInterface;
use Majora\Framework\Loader\Bridge\Api\AbstractApiLoader;

/**
 * Test2 repository implementation using graph database.
 */
class Test2ApiLoader extends AbstractApiLoader
    implements Test2LoaderInterface
{
    use Auto\Test2ApiLoaderTrait;
}
