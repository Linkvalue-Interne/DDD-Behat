<?php

namespace Sir\Partner\Component\Loader\Doctrine;

use Sir\Partner\Component\Loader\PersonLoaderInterface;
use Majora\Framework\Loader\Bridge\Doctrine\AbstractDoctrineLoader;

/**
 * Person repository implementation using graph database.
 */
class PersonDoctrineLoader extends AbstractDoctrineLoader
    implements PersonLoaderInterface
{
    use Auto\PersonDoctrineLoaderTrait;
}
