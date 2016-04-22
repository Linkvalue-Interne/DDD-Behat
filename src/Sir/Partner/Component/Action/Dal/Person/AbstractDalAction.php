<?php

namespace Sir\Partner\Component\Action\Dal\Person;

use Sir\Partner\Component\Action\AbstractPersonAction;
use Majora\Framework\Domain\Action\Dal\DalActionTrait;

/**
 * Base class for Person Dal centric actions.
 *
 * @property $person
 */
abstract class AbstractDalAction extends AbstractPersonAction
{
    use DalActionTrait;
}
