<?php

namespace Lv\Example\Component\Action\Api\Entity;

use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Entity deletion action representation.
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
            array('id' => $this->entity->getId())
        );
    }
}
