<?php

namespace Lv\Example\Component\Domain;

use Lv\Example\Component\Entity\Entity;

/**
 * Interface for Entity domain use cases.
 */
interface EntityDomainInterface
{
    /**
     * Create and returns an action for create a Entity.
     *
     * @return CreateEntityAction
     */
    public function create();

    /**
     * Create and returns an action for update a Entity.
     *
     * @param Entity $entity
     *
     * @return UpdateEntityAction
     */
    public function update(Entity $entity);

    /**
     * Create and returns an action for delete a Entity.
     *
     * @param Entity $entity
     *
     * @return DeleteEntityAction
     */
    public function delete(Entity $entity);
}
