<?php

namespace MajoraVendor\MajoraNamespace\Component\Repository\Doctrine;

use MajoraVendor\MajoraNamespace\Component\Repository\MajoraEntityRepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;

/**
 * MajoraEntity repository implementation using graph database.
 */
class MajoraEntityDoctrineRepository extends BaseDoctrineRepository
    implements MajoraEntityRepositoryInterface
{
    use Auto\MajoraEntityDoctrineRepositoryTrait;
}
