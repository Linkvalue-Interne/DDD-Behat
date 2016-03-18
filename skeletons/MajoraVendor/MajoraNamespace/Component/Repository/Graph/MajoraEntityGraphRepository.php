<?php

namespace MajoraVendor\MajoraNamespace\Component\Repository\Graph;

use MajoraVendor\MajoraNamespace\Component\Repository\MajoraEntityRepositoryInterface;
use Majora\Framework\Repository\Graph\AbstractGraphRepository;

/**
 * MajoraEntity repository implementation using graph database.
 */
class MajoraEntityGraphRepository extends AbstractGraphRepository
    implements MajoraEntityRepositoryInterface
{
    use Auto\MajoraEntityGraphRepositoryTrait;
}
