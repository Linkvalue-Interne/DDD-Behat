<?php

namespace Sir\Partner\Component\Action\Dal\Person;

use Sir\Partner\Component\Event\PersonEvent;
use Sir\Partner\Component\Event\PersonEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person deletion action representation.
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
            PersonEvents::SIR_PERSON_DELETED,
            new PersonEvent($this->person, $this)
        );
    }
}
