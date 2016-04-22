<?php

namespace Sir\Partner\Component\Repository\Doctrine;

use Sir\Partner\Component\Repository\PersonRepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;

/**
 * Person repository implementation using graph database.
 */
class PersonDoctrineRepository extends BaseDoctrineRepository
    implements PersonRepositoryInterface
{
    use Auto\PersonDoctrineRepositoryTrait;
}
