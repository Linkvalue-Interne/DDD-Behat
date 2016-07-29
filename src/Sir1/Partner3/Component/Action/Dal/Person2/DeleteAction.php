<?php

namespace Sir1\Partner3\Component\Action\Dal\Person2;

use Sir1\Partner3\Component\Event\Person2Event;
use Sir1\Partner3\Component\Event\Person2Events;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person2 deletion action representation.
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
            Person2Events::SIR1_PERSON2_DELETED,
            new Person2Event($this->person2, $this)
        );
    }
}
