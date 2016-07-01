<?php

namespace Test2\Test2\Component\Action\Dal\Test2;

use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Event\Test2Event;
use Test2\Test2\Component\Event\Test2Events;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Test2 creation action representation.
 */
class CreateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * Test2 creation method.
     *
     * @return Test2
     */
    public function resolve()
    {
        $this->test2 = new Test2();
        $this->test2->deserialize($this->serialize());

        $this->assertEntityIsValid($this->test2, array('Test2', 'creation'));

        $this->fireEvent(
            Test2Events::TEST2_TEST2_CREATED,
            new Test2Event($this->test2, $this)
        );

        return $this->test2;
    }
}
