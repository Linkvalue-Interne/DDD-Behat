<?php

namespace Lv\Example\Component\Repository\Doctrine;

use Lv\Example\Component\Repository\EntityRepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;

/**
 * Entity repository implementation using graph database.
 */
class EntityDoctrineRepository extends BaseDoctrineRepository
    implements EntityRepositoryInterface
{
    use Auto\EntityDoctrineRepositoryTrait;
}
