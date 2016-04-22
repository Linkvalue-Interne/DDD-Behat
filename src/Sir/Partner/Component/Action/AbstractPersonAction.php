<?php

namespace Sir\Partner\Component\Action;

use Sir\Partner\Component\Entity\Person;
use Majora\Framework\Domain\Action\AbstractAction;

/**
 * Base class for PersonActions.
 *
 * @property $person
 */
abstract class AbstractPersonAction extends AbstractAction
{
    /**
     * @var Person
     */
    protected $person;

    /**
     * Initialisation function.
     *
     * @param Person $person
     */
    public function init(Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Return related Person if defined.
     *
     * @return Person|null $person
     */
    public function getPerson()
    {
        return $this->person;
    }
}
