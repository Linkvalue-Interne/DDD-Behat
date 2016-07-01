<?php

namespace Test2\Test2\Component\Loader\Doctrine;

use Test2\Test2\Component\Loader\Test2LoaderInterface;
use Majora\Framework\Loader\Bridge\Doctrine\AbstractDoctrineLoader;

/**
 * Test2 repository implementation using graph database.
 */
class Test2DoctrineLoader extends AbstractDoctrineLoader
    implements Test2LoaderInterface
{
    use Auto\Test2DoctrineLoaderTrait;
}
