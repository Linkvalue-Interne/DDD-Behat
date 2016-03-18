<?php

namespace Acme\Lv\Component\Repository\Doctrine;

use Acme\Lv\Component\Repository\PostRepositoryInterface;
use Majora\Framework\Repository\Doctrine\BaseDoctrineRepository;

/**
 * Post repository implementation using graph database.
 */
class PostDoctrineRepository extends BaseDoctrineRepository
    implements PostRepositoryInterface
{
    use Auto\PostDoctrineRepositoryTrait;
}
