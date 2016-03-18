<?php

namespace MajoraVendor\MajoraNamespace\Component\Loader\Graph;

use MajoraVendor\MajoraNamespace\Component\Loader\MajoraEntityLoaderInterface;
use Majora\Framework\Loader\Bridge\Graph\AbstractGraphLoader;

/**
 * MajoraEntity repository implementation using graph database.
 */
class MajoraEntityGraphLoader extends AbstractGraphLoader
    implements MajoraEntityLoaderInterface
{
    use Auto\MajoraEntityGraphLoaderTrait;
}
