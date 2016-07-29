<?php

namespace Sir1\Partner3\Component\Action\Api\Person2;

use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person2 deletion action representation.
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
            array('id' => $this->person2->getId())
        );
    }
}
