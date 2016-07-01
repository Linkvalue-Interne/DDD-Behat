<?php

namespace Test2\Test2\Component\Domain;

use Test2\Test2\Component\Entity\Test2;

/**
 * Interface for Test2 domain use cases.
 */
interface Test2DomainInterface
{
    /**
     * Create and returns an action for create a Test2.
     *
     * @return CreateTest2Action
     */
    public function create();

    /**
     * Create and returns an action for update a Test2.
     *
     * @param Test2 $test2
     *
     * @return UpdateTest2Action
     */
    public function update(Test2 $test2);

    /**
     * Create and returns an action for delete a Test2.
     *
     * @param Test2 $test2
     *
     * @return DeleteTest2Action
     */
    public function delete(Test2 $test2);
}
