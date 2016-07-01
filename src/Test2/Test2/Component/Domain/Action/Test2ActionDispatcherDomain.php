<?php

namespace Test2\Test2\Component\Domain\Action;

use Test2\Test2\Component\Domain\Test2DomainInterface;
use Majora\Framework\Domain\ActionDispatcherDomain;

/**
 * Test2 domain use cases class.
 *
 * Auto generated methods :
 *
 * @method create()
 * @method update(Test2 $test2)
 * @method delete(Test2 $test2)
 */
class Test2ActionDispatcherDomain extends ActionDispatcherDomain
    implements Test2DomainInterface
{
    use Auto\Test2ActionDispatcherDomainTrait;
}
