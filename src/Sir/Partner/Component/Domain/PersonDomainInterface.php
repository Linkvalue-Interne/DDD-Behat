<?php

namespace Sir\Partner\Component\Domain;

use Sir\Partner\Component\Entity\Person;

/**
 * Interface for Person domain use cases.
 */
interface PersonDomainInterface
{
    /**
     * Create and returns an action for create a Person.
     *
     * @return CreatePersonAction
     */
    public function create();

    /**
     * Create and returns an action for update a Person.
     *
     * @param Person $person
     *
     * @return UpdatePersonAction
     */
    public function update(Person $person);

    /**
     * Create and returns an action for delete a Person.
     *
     * @param Person $person
     *
     * @return DeletePersonAction
     */
    public function delete(Person $person);
}
