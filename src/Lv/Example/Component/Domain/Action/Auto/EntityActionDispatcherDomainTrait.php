<?php

namespace Lv\Example\Component\Domain\Action\Auto;

use Lv\Example\Component\Entity\Entity;

/**
 * Entity domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @method resolve()
 *
 * @codeCoverageIgnore
 */
trait EntityActionDispatcherDomainTrait
{
    /**
     * @see EntityDomainInterface::create()
     */
    public function create(...$arguments)
    {
        return $this->getAction('create', null, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see EntityDomainInterface::update()
     */
    public function update(Entity $entity, ...$arguments)
    {
        return $this->getAction('update', $entity, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see EntityDomainInterface::delete()
     */
    public function delete(Entity $entity, ...$arguments)
    {
        return $this->getAction('delete', $entity, ...$arguments)
            ->resolve()
        ;
    }
}
