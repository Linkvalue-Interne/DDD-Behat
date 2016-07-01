<?php

namespace Test2\Test2\Component\Action\Dal\Test2;

use Test2\Test2\Component\Action\AbstractTest2Action;
use Majora\Framework\Domain\Action\Dal\DalActionTrait;

/**
 * Base class for Test2 Dal centric actions.
 *
 * @property $test2
 */
abstract class AbstractDalAction extends AbstractTest2Action
{
    use DalActionTrait;
}
