<?php

namespace Lv\Example\Component\Action\Dal\Entity;

use Lv\Example\Component\Action\AbstractEntityAction;
use Majora\Framework\Domain\Action\Dal\DalActionTrait;

/**
 * Base class for Entity Dal centric actions.
 *
 * @property $entity
 */
abstract class AbstractDalAction extends AbstractEntityAction
{
    use DalActionTrait;
}
