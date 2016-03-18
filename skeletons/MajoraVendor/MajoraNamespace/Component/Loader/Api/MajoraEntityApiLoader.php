<?php

namespace MajoraVendor\MajoraNamespace\Component\Loader\Api;

use MajoraVendor\MajoraNamespace\Component\Loader\MajoraEntityLoaderInterface;
use Majora\Framework\Loader\Bridge\Api\AbstractApiLoader;

/**
 * MajoraEntity repository implementation using graph database.
 */
class MajoraEntityApiLoader extends AbstractApiLoader
    implements MajoraEntityLoaderInterface
{
    use Auto\MajoraEntityApiLoaderTrait;
}
