<?php

namespace Acme\Lv\Component\Loader\Doctrine;

use Acme\Lv\Component\Loader\PostLoaderInterface;
use Majora\Framework\Loader\Bridge\Doctrine\AbstractDoctrineLoader;

/**
 * Post repository implementation using graph database.
 */
class PostDoctrineLoader extends AbstractDoctrineLoader
    implements PostLoaderInterface
{
    use Auto\PostDoctrineLoaderTrait;
}
