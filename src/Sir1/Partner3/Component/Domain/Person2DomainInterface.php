<?php

namespace Sir1\Partner3\Component\Domain;

use Sir1\Partner3\Component\Entity\Person2;

/**
 * Interface for Person2 domain use cases.
 */
interface Person2DomainInterface
{
    /**
     * Create and returns an action for create a Person2.
     *
     * @return CreatePerson2Action
     */
    public function create();

    /**
     * Create and returns an action for update a Person2.
     *
     * @param Person2 $person2
     *
     * @return UpdatePerson2Action
     */
    public function update(Person2 $person2);

    /**
     * Create and returns an action for delete a Person2.
     *
     * @param Person2 $person2
     *
     * @return DeletePerson2Action
     */
    public function delete(Person2 $person2);
}
