<?php

namespace Sir1\Partner3\Component\Loader\Graph;

use Sir1\Partner3\Component\Loader\Person2LoaderInterface;
use Majora\Framework\Loader\Bridge\Graph\AbstractGraphLoader;

/**
 * Person2 repository implementation using graph database.
 */
class Person2GraphLoader extends AbstractGraphLoader
    implements Person2LoaderInterface
{
    use Auto\Person2GraphLoaderTrait;
}
