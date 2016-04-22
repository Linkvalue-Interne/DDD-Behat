<?php

namespace Sir\Partner\Component\Action\Dal\Person;

use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Event\PersonEvent;
use Sir\Partner\Component\Event\PersonEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person creation action representation.
 */
class CreateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * Person creation method.
     *
     * @return Person
     */
    public function resolve()
    {
        $this->person = new Person();
        $this->person->deserialize($this->serialize());

        $this->assertEntityIsValid($this->person, array('Person', 'creation'));

        $this->fireEvent(
            PersonEvents::SIR_PERSON_CREATED,
            new PersonEvent($this->person, $this)
        );

        return $this->person;
    }
}
