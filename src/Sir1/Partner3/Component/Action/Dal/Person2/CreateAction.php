<?php

namespace Sir1\Partner3\Component\Action\Dal\Person2;

use Sir1\Partner3\Component\Entity\Person2;
use Sir1\Partner3\Component\Event\Person2Event;
use Sir1\Partner3\Component\Event\Person2Events;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person2 creation action representation.
 */
class CreateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * Person2 creation method.
     *
     * @return Person2
     */
    public function resolve()
    {
        $this->person2 = new Person2();
        $this->person2->deserialize($this->serialize());

        $this->assertEntityIsValid($this->person2, array('Person2', 'creation'));

        $this->fireEvent(
            Person2Events::SIR1_PERSON2_CREATED,
            new Person2Event($this->person2, $this)
        );

        return $this->person2;
    }
}
