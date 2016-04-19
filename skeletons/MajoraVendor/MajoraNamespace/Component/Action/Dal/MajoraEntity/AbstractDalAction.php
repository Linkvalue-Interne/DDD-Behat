<?php

namespace MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Action\AbstractMajoraEntityAction;
use Majora\Framework\Domain\Action\Dal\DalActionTrait;

/**
 * Base class for MajoraEntity Dal centric actions.
 *
 * @property $majoraEntity
 */
abstract class AbstractDalAction extends AbstractMajoraEntityAction
{
    use DalActionTrait;
}
