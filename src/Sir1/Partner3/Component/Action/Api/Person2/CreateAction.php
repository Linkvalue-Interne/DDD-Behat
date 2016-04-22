<?php

namespace Sir1\Partner3\Component\Action\Api\Person2;

use Sir1\Partner3\Component\Entity\Person2;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person2 creation action representation.
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
     * Person2 creation method.
     *
     * @return Person2
     */
    public function resolve()
    {
        // Api post call
        $response = $this->getRestApiClient()->post(
            array(),
            $this->serialize()
        );

        // parsing response
        $this->person2 = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            Person2::class,
            'json'
        );

        return $this->person2;
    }
}
