<?php

namespace MajoraVendor\MajoraNamespace\Component\Loader\Doctrine;

use MajoraVendor\MajoraNamespace\Component\Loader\MajoraEntityLoaderInterface;
use Majora\Framework\Loader\Bridge\Doctrine\AbstractDoctrineLoader;

/**
 * MajoraEntity repository implementation using graph database.
 */
class MajoraEntityDoctrineLoader extends AbstractDoctrineLoader
    implements MajoraEntityLoaderInterface
{
    use Auto\MajoraEntityDoctrineLoaderTrait;
}
