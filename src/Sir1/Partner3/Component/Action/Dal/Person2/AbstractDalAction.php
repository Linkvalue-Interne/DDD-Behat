<?php

namespace Sir1\Partner3\Component\Action\Dal\Person2;

use Sir1\Partner3\Component\Action\AbstractPerson2Action;
use Majora\Framework\Domain\Action\Dal\DalActionTrait;

/**
 * Base class for Person2 Dal centric actions.
 *
 * @property $person2
 */
abstract class AbstractDalAction extends AbstractPerson2Action
{
    use DalActionTrait;
}
