<?php

namespace Test2\Test2\Component\Action\Api\Test2;

use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Test2 deletion action representation.
 *
 * @see Majora\Framework\Domain\Action\ActionTrait;
 *
 * @method getRestApiClient() : Majora\Framework\Api\Client\RestApiClient
 */
class DeleteAction extends AbstractApiAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Api delete call
        $this->getRestApiClient()->delete(
            array('id' => $this->test2->getId())
        );
    }
}
