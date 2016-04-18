<?php

namespace MajoraVendor\MajoraNamespace\Component\Domain\Action\Auto;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;

/**
 * MajoraEntity domain use cases auto generated trait.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @method resolve()
 *
 * @codeCoverageIgnore
 */
trait MajoraEntityActionDispatcherDomainTrait
{
    /**
     * @see MajoraEntityDomainInterface::create()
     */
    public function create(...$arguments)
    {
        return $this->getAction('create', null, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see MajoraEntityDomainInterface::edit()
     */
    public function edit(MajoraEntity $majoraEntity, ...$arguments)
    {
        return $this->getAction('edit', $majoraEntity, ...$arguments)
            ->resolve()
        ;
    }
    /**
     * @see MajoraEntityDomainInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity, ...$arguments)
    {
        return $this->getAction('delete', $majoraEntity, ...$arguments)
            ->resolve()
        ;
    }
}
