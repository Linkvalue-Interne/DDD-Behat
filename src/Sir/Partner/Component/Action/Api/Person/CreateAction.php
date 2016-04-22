<?php

namespace Sir\Partner\Component\Action\Api\Person;

use Sir\Partner\Component\Entity\Person;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Person creation action representation.
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
     * Person creation method.
     *
     * @return Person
     */
    public function resolve()
    {
        // Api post call
        $response = $this->getRestApiClient()->post(
            array(),
            $this->serialize()
        );

        // parsing response
        $this->person = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            Person::class,
            'json'
        );

        return $this->person;
    }
}
