<?php

namespace Sir1\Partner3\Component\Action\Api\Person2;

use Majora\Framework\Domain\Action\DynamicActionTrait;
use Sir1\Partner3\Component\Entity\Person2;

/**
 * Person2 edition action representation.
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
        return Person2::getScopes();
    }

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Api put call
        $response = $this->getRestApiClient()->put(
            array('id' => $this->person2->getId()),
            $this->serialize()
        );

        // Generic Person2 hydration from this action magic accessors
        $this->person2 = $this->getSerializer()->deserialize(
            (string) $this->getSerializer()->serialize($this, 'json'),
            Person2::class,
            'json'
        );
    }
}
