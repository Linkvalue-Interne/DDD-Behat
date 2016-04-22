<?php

namespace Sir\Partner\Component\Domain\Action;

use Sir\Partner\Component\Domain\PersonDomainInterface;
use Majora\Framework\Domain\ActionDispatcherDomain;

/**
 * Person domain use cases class.
 *
 * Auto generated methods :
 *
 * @method create()
 * @method update(Person $person)
 * @method delete(Person $person)
 */
class PersonActionDispatcherDomain extends ActionDispatcherDomain
    implements PersonDomainInterface
{
    use Auto\PersonActionDispatcherDomainTrait;
}
