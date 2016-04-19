<?php

namespace Acme\Lv\Component\Action\Api\Post;

use Majora\Framework\Domain\Action\DynamicActionTrait;
use Acme\Lv\Component\Entity\Post;

/**
 * Post edition action representation.
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
        return Post::getScopes();
    }

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        // Api put call
        $response = $this->getRestApiClient()->put(
            array('id' => $this->post->getId()),
            $this->serialize()
        );

        // Generic Post hydration from this action magic accessors
        $this->post = $this->getSerializer()->deserialize(
            (string) $this->getSerializer()->serialize($this, 'json'),
            Post::class,
            'json'
        );
    }

}
