<?php

namespace Sir\Partner\Component\Action\Api\Person;

use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person deletion action representation.
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
            array('id' => $this->person->getId())
        );
    }
}
