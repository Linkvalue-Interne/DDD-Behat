<?php

namespace Lv\Example\Component\Action\Api\Entity;

use Majora\Framework\Domain\Action\DynamicActionTrait;
use Lv\Example\Component\Entity\Entity;

/**
 * Entity edition action representation.
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
     * @see ScopableInterface::getScopes()
     */
    public static function getScopes()
    {
        return Entity::getScopes();
    }

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Api put call
        $response = $this->getRestApiClient()->put(
            array('id' => $this->entity->getId()),
            $this->serialize()
        );

        // Generic Entity hydration from this action magic accessors
        $this->entity = $this->getSerializer()->deserialize(
            (string) $this->getSerializer()->serialize($this, 'json'),
            Entity::class,
            'json'
        );
    }
}
