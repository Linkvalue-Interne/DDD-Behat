<?php

namespace Sir1\Partner3\Component\Action\Dal\Person2;

use Sir1\Partner3\Component\Event\Person2Event;
use Sir1\Partner3\Component\Event\Person2Events;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person2 edition action representation.
 */
class UpdateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->person2->deserialize($this->serialize());

        $this->assertEntityIsValid($this->person2, array('Person2', 'edition'));

        $this->fireEvent(
            Person2Events::SIR1_PERSON2_EDITED,
            new Person2Event($this->person2, $this)
        );
    }
}
