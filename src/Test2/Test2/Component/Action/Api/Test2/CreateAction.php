<?php

namespace Test2\Test2\Component\Action\Api\Test2;

use Test2\Test2\Component\Entity\Test2;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Test2 creation action representation.
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
     * Test2 creation method.
     *
     * @return Test2
     */
    public function resolve()
    {
        // Api post call
        $response = $this->getRestApiClient()->post(
            array(),
            $this->serialize()
        );

        // parsing response
        $this->test2 = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            Test2::class,
            'json'
        );

        return $this->test2;
    }
}
