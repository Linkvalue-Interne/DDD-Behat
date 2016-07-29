<?php

namespace Sir1\Partner3\Component\Domain\Action;

use Sir1\Partner3\Component\Domain\Person2DomainInterface;
use Majora\Framework\Domain\ActionDispatcherDomain;

/**
 * Person2 domain use cases class.
 *
 * Auto generated methods :
 *
 * @method create()
 * @method update(Person2 $person2)
 * @method delete(Person2 $person2)
 */
class Person2ActionDispatcherDomain extends ActionDispatcherDomain
    implements Person2DomainInterface
{
    use Auto\Person2ActionDispatcherDomainTrait;
}
