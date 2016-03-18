<?php

namespace Acme\Lv\Component\Action\Api\Post;

use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Post deletion action representation.
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
            array('id' => $this->post->getId())
        );
    }
}
