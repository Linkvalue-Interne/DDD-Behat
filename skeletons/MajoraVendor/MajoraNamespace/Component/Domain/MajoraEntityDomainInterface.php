<?php

namespace MajoraVendor\MajoraNamespace\Component\Domain;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;

/**
 * Interface for MajoraEntity domain use cases.
 */
interface MajoraEntityDomainInterface
{
    /**
     * Create and returns an action for create a MajoraEntity.
     *
     * @return CreateMajoraEntityAction
     */
    public function create();

    /**
     * Create and returns an action for update a MajoraEntity.
     *
     * @param MajoraEntity $majoraEntity
     *
     * @return UpdateMajoraEntityAction
     */
    public function edit(MajoraEntity $majoraEntity);

    /**
     * Create and returns an action for delete a MajoraEntity.
     *
     * @param MajoraEntity $majoraEntity
     *
     * @return DeleteMajoraEntityAction
     */
    public function delete(MajoraEntity $majoraEntity);
}
