<?php

namespace Sir1\Partner3\Component\Action;

use Sir1\Partner3\Component\Entity\Person2;
use Majora\Framework\Domain\Action\AbstractAction;

/**
 * Base class for Person2Actions.
 *
 * @property $person2
 */
abstract class AbstractPerson2Action extends AbstractAction
{
    /**
     * @var Person2
     */
    protected $person2;

    /**
     * Initialisation function.
     *
     * @param Person2 $person2
     */
    public function init(Person2 $person2 = null)
    {
        $this->person2 = $person2;

        return $this;
    }

    /**
     * Return related Person2 if defined.
     *
     * @return Person2|null $person2
     */
    public function getPerson2()
    {
        return $this->person2;
    }
}
