<?php

namespace MajoraVendor\MajoraNamespace\Component\Action\Api\MajoraEntity;

use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * MajoraEntity edition action representation.
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
        // Generic MajoraEntity hydration from this action magic accessors
        $this->majoraEntity->deserialize(
            $actionData = $this->serialize()
        );

        // Api put call
        $this->getRestApiClient()->put(
            array('id' => $this->majoraEntity->getId()),
            $actionData
        );
    }
}
