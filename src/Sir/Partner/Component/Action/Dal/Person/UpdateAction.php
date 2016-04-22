<?php

namespace Sir\Partner\Component\Action\Dal\Person;

use Sir\Partner\Component\Event\PersonEvent;
use Sir\Partner\Component\Event\PersonEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person edition action representation.
 */
class UpdateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->person->deserialize($this->serialize());

        $this->assertEntityIsValid($this->person, array('Person', 'edition'));

        $this->fireEvent(
            PersonEvents::SIR_PERSON_EDITED,
            new PersonEvent($this->person, $this)
        );
    }
}
