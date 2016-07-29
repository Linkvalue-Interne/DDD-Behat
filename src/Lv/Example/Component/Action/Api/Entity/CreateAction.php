<?php

namespace Lv\Example\Component\Action\Api\Entity;

use Lv\Example\Component\Entity\Entity;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Entity creation action representation.
 *
 * @see Majora\Framework\Domain\Action\ActionTrait
 * @see Majora\Framework\Domain\Action\DynamicActionTrait;
 * @see Majora\Framework\Serializer\Model\SerializableInterface
 *
 * @method getRestApiClient() : Majora\Framework\Api\Client\RestApiClient
 * @method getSerializer() : Symfony\Component\Serializer\SerializerInterface
 * @method serialize() : array
 */
class CreateAction extends AbstractApiAction
{
    use DynamicActionTrait;

    /**
     * Entity creation method.
     *
     * @return Entity
     */
    public function resolve()
    {
        // Api post call
        $response = $this->getRestApiClient()->post(
            array(),
            $this->serialize()
        );

        // parsing response
        $this->entity = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            Entity::class,
            'json'
        );

        return $this->entity;
    }
}
