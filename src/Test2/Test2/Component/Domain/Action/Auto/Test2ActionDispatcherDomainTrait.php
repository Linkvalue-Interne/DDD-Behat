<?php

namespace Test2\Test2\Component\Domain\Action\Auto;

use Test2\Test2\Component\Entity\Test2;

/**
 * Test2 domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @method resolve()
 *
 * @codeCoverageIgnore
 */
trait Test2ActionDispatcherDomainTrait
{
    /**
     * @see Test2DomainInterface::create()
     */
    public function create(...$arguments)
    {
        return $this->getAction('create', null, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see Test2DomainInterface::update()
     */
    public function update(Test2 $test2, ...$arguments)
    {
        return $this->getAction('update', $test2, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see Test2DomainInterface::delete()
     */
    public function delete(Test2 $test2, ...$arguments)
    {
        return $this->getAction('delete', $test2, ...$arguments)
            ->resolve()
        ;
    }
}
