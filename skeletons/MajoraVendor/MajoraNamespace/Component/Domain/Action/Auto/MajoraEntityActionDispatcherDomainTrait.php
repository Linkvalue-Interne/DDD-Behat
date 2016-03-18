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
    public function create()
    {
        return $this->resolve('create');
    }

    /**
     * @see MajoraEntityDomainInterface::edit()
     */
    public function edit(MajoraEntity $majoraEntity)
    {
        return $this->resolve('edit', $majoraEntity);
    }

    /**
     * @see MajoraEntityDomainInterface::delete()
     */
    public function delete(MajoraEntity $majoraEntity)
    {
        return $this->resolve('delete', $majoraEntity);
    }
}
