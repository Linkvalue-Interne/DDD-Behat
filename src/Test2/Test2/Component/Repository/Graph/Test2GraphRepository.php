<?php

namespace Test2\Test2\Component\Repository\Graph;

use Test2\Test2\Component\Repository\Test2RepositoryInterface;
use Majora\Framework\Repository\Graph\AbstractGraphRepository;

/**
 * Test2 repository implementation using graph database.
 */
class Test2GraphRepository extends AbstractGraphRepository
    implements Test2RepositoryInterface
{
    use Auto\Test2GraphRepositoryTrait;
}
