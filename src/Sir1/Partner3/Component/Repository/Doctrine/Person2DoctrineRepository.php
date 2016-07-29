<?php

namespace Sir1\Partner3\Component\Repository\Doctrine;

use Sir1\Partner3\Component\Repository\Person2RepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;

/**
 * Person2 repository implementation using graph database.
 */
class Person2DoctrineRepository extends BaseDoctrineRepository
    implements Person2RepositoryInterface
{
    use Auto\Person2DoctrineRepositoryTrait;
}
