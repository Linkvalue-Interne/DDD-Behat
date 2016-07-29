<?php

namespace Sir1\Partner3\Component\Loader\Api;

use Sir1\Partner3\Component\Loader\Person2LoaderInterface;
use Majora\Framework\Loader\Bridge\Api\AbstractApiLoader;

/**
 * Person2 repository implementation using graph database.
 */
class Person2ApiLoader extends AbstractApiLoader
    implements Person2LoaderInterface
{
    use Auto\Person2ApiLoaderTrait;
}
