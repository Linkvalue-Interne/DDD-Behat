<?php

namespace Sir\Partner\Component\Domain\Action\Auto;

use Sir\Partner\Component\Entity\Person;

/**
 * Person domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @method resolve()
 *
 * @codeCoverageIgnore
 */
trait PersonActionDispatcherDomainTrait
{
    /**
     * @see PersonDomainInterface::create()
     */
    public function create(...$arguments)
    {
        return $this->getAction('create', null, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see PersonDomainInterface::update()
     */
    public function update(Person $person, ...$arguments)
    {
        return $this->getAction('update', $person, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see PersonDomainInterface::delete()
     */
    public function delete(Person $person, ...$arguments)
    {
        return $this->getAction('delete', $person, ...$arguments)
            ->resolve()
        ;
    }
}
