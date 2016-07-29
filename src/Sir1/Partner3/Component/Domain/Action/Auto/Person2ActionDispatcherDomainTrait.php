<?php

namespace Sir1\Partner3\Component\Domain\Action\Auto;

use Sir1\Partner3\Component\Entity\Person2;

/**
 * Person2 domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @method resolve()
 *
 * @codeCoverageIgnore
 */
trait Person2ActionDispatcherDomainTrait
{
    /**
     * @see Person2DomainInterface::create()
     */
    public function create(...$arguments)
    {
        return $this->getAction('create', null, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see Person2DomainInterface::update()
     */
    public function update(Person2 $person2, ...$arguments)
    {
        return $this->getAction('update', $person2, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see Person2DomainInterface::delete()
     */
    public function delete(Person2 $person2, ...$arguments)
    {
        return $this->getAction('delete', $person2, ...$arguments)
            ->resolve()
        ;
    }
}
