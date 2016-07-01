<?php

namespace Test2\Test2\Component\Action\Api\Test2;

use Majora\Framework\Domain\Action\DynamicActionTrait;
use Test2\Test2\Component\Entity\Test2;

/**
 * Test2 edition action representation.
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
        return Test2::getScopes();
    }

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Api put call
        $response = $this->getRestApiClient()->put(
            array('id' => $this->test2->getId()),
            $this->serialize()
        );

        // Generic Test2 hydration from this action magic accessors
        $this->test2 = $this->getSerializer()->deserialize(
            (string) $this->getSerializer()->serialize($this, 'json'),
            Test2::class,
            'json'
        );
    }
}
