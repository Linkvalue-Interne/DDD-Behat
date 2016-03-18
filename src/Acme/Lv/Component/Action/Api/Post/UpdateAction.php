<?php

namespace Acme\Lv\Component\Action\Api\Post;

use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Post edition action representation.
 *
 * @see Majora\Framework\Domain\Action\ActionTrait;
 * @see Majora\Framework\Domain\Action\DynamicActionTrait;
 *
 * @method getRestApiClient() : Majora\Framework\Api\Client\RestApiClient
 * @method getSerializer() : Symfony\Component\Serializer\SerializerInterface
 * @method setIfDefined($object, $field) : mixed
 */
class UpdateAction extends AbstractApiAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Generic Post hydration from this action magic accessors
        $this->post->deserialize(
            $actionData = $this->serialize()
        );

        // Api put call
        $this->getRestApiClient()->put(
            array('id' => $this->post->getId()),
            $actionData
        );
    }
}
