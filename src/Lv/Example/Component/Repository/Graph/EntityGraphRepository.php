<?php

namespace Lv\Example\Component\Repository\Graph;

use Lv\Example\Component\Repository\EntityRepositoryInterface;
use Majora\Framework\Repository\Graph\AbstractGraphRepository;

/**
 * Entity repository implementation using graph database.
 */
class EntityGraphRepository extends AbstractGraphRepository
    implements EntityRepositoryInterface
{
    use Auto\EntityGraphRepositoryTrait;
}
