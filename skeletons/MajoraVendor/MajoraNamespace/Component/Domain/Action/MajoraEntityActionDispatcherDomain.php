<?php

namespace MajoraVendor\MajoraNamespace\Component\Domain\Action;

use MajoraVendor\MajoraNamespace\Component\Domain\MajoraEntityDomainInterface;
use Majora\Framework\Domain\ActionDispatcherDomain;

/**
 * MajoraEntity domain use cases class.
 *
 * Auto generated methods :
 *
 * @method create()
 * @method update(MajoraEntity $majoraEntity)
 * @method delete(MajoraEntity $majoraEntity)
 */
class MajoraEntityActionDispatcherDomain extends ActionDispatcherDomain
    implements MajoraEntityDomainInterface
{
    use Auto\MajoraEntityActionDispatcherDomainTrait;
}
