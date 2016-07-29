<?php

namespace Sir1\Partner3\Component\Loader\Doctrine;

use Sir1\Partner3\Component\Loader\Person2LoaderInterface;
use Majora\Framework\Loader\Bridge\Doctrine\AbstractDoctrineLoader;

/**
 * Person2 repository implementation using graph database.
 */
class Person2DoctrineLoader extends AbstractDoctrineLoader
    implements Person2LoaderInterface
{
    use Auto\Person2DoctrineLoaderTrait;
}
