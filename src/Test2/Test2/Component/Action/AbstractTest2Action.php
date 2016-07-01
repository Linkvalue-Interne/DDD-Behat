<?php

namespace Test2\Test2\Component\Action;

use Test2\Test2\Component\Entity\Test2;
use Majora\Framework\Domain\Action\AbstractAction;

/**
 * Base class for Test2Actions.
 *
 * @property $test2
 */
abstract class AbstractTest2Action extends AbstractAction
{
    /**
     * @var Test2
     */
    protected $test2;

    /**
     * Initialisation function.
     *
     * @param Test2 $test2
     */
    public function init(Test2 $test2 = null)
    {
        $this->test2 = $test2;

        return $this;
    }

    /**
     * Return related Test2 if defined.
     *
     * @return Test2|null $test2
     */
    public function getTest2()
    {
        return $this->test2;
    }
}
