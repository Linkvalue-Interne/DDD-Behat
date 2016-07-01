<?php

namespace Test2\Test2\Component\Repository\Doctrine;

use Test2\Test2\Component\Repository\Test2RepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;

/**
 * Test2 repository implementation using graph database.
 */
class Test2DoctrineRepository extends BaseDoctrineRepository
    implements Test2RepositoryInterface
{
    use Auto\Test2DoctrineRepositoryTrait;
}
