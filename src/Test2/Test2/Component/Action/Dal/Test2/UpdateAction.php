<?php

namespace Test2\Test2\Component\Action\Dal\Test2;

use Test2\Test2\Component\Event\Test2Event;
use Test2\Test2\Component\Event\Test2Events;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Test2 edition action representation.
 */
class UpdateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->test2->deserialize($this->serialize());

        $this->assertEntityIsValid($this->test2, array('Test2', 'edition'));

        $this->fireEvent(
            Test2Events::TEST2_TEST2_EDITED,
            new Test2Event($this->test2, $this)
        );
    }
}
