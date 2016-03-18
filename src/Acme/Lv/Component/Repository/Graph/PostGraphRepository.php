<?php

namespace Acme\Lv\Component\Repository\Graph;

use Acme\Lv\Component\Repository\PostRepositoryInterface;
use Majora\Framework\Repository\Graph\AbstractGraphRepository;

/**
 * Post repository implementation using graph database.
 */
class PostGraphRepository extends AbstractGraphRepository
    implements PostRepositoryInterface
{
    use Auto\PostGraphRepositoryTrait;
}
