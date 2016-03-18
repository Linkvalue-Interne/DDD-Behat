<?php

namespace MajoraVendor\MajoraNamespace\Component\Action\Api\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * MajoraEntity creation action representation.
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
     * MajoraEntity creation method.
     *
     * @return MajoraEntity
     */
    public function resolve()
    {
        // Api post call
        $response = $this->getRestApiClient()->post(
            array(),
            $this->serialize()
        );

        // parsing response
        $this->majoraEntity = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            MajoraEntity::class,
            'json'
        );

        return $this->majoraEntity;
    }
}
