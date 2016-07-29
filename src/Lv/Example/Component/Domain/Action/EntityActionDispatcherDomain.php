<?php

namespace Lv\Example\Component\Domain\Action;

use Lv\Example\Component\Domain\EntityDomainInterface;
use Majora\Framework\Domain\ActionDispatcherDomain;

/**
 * Entity domain use cases class.
 *
 * Auto generated methods :
 *
 * @method create()
 * @method update(Entity $entity)
 * @method delete(Entity $entity)
 */
class EntityActionDispatcherDomain extends ActionDispatcherDomain
    implements EntityDomainInterface
{
    use Auto\EntityActionDispatcherDomainTrait;
}
