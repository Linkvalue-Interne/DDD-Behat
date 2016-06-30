<?php

namespace Sir\Partner\Component\Action\Api\Person;

use Majora\Framework\Domain\Action\DynamicActionTrait;
use Sir\Partner\Component\Entity\Person;

/**
 * Person edition action representation.
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
        return Person::getScopes();
    }

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Api put call
        $response = $this->getRestApiClient()->put(
            array('id' => $this->person->getId()),
            $this->serialize()
        );

        // Generic Person hydration from this action magic accessors
        $this->person = $this->getSerializer()->deserialize(
            (string) $this->getSerializer()->serialize($this, 'json'),
            Person::class,
            'json'
        );
    }
}
