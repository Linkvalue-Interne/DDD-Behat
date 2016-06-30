<?php

namespace Sir\Partner\Component\Repository\Graph;

use Sir\Partner\Component\Repository\PersonRepositoryInterface;
use Majora\Framework\Repository\Graph\AbstractGraphRepository;

/**
 * Person repository implementation using graph database.
 */
class PersonGraphRepository extends AbstractGraphRepository
    implements PersonRepositoryInterface
{
    use Auto\PersonGraphRepositoryTrait;
}
