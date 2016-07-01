<?php

namespace Test2\Test2\Component\Action\Dal\Test2;

use Test2\Test2\Component\Event\Test2Event;
use Test2\Test2\Component\Event\Test2Events;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Test2 deletion action representation.
 */
class DeleteAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->fireEvent(
            Test2Events::TEST2_TEST2_DELETED,
            new Test2Event($this->test2, $this)
        );
    }
}
