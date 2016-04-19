<?php

namespace MajoraVendor\MajoraNamespace\Component\Action\Api\MajoraEntity;

use Majora\Framework\Domain\Action\DynamicActionTrait;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;

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
     * @see ScopableInterface::getScopes()
     */
    public static function getScopes()
    {
        return MajoraEntity::getScopes();
    }

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Api put call
        $response = $this->getRestApiClient()->put(
            array('id' => $this->majoraEntity->getId()),
            $this->serialize()
        );

        // Generic MajoraEntity hydration from this action magic accessors
        $this->majoraEntity = $this->getSerializer()->deserialize(
            (string) $this->getSerializer()->serialize($this, 'json'),
            MajoraEntity::class,
            'json'
        );
    }
}
