<?php

namespace Sir1\Partner3\Component\Repository\Graph;

use Sir1\Partner3\Component\Repository\Person2RepositoryInterface;
use Majora\Framework\Repository\Graph\AbstractGraphRepository;

/**
 * Person2 repository implementation using graph database.
 */
class Person2GraphRepository extends AbstractGraphRepository
    implements Person2RepositoryInterface
{
    use Auto\Person2GraphRepositoryTrait;
}
