<?php

namespace Acme\Lv\Component\Action\Api\Post;

use Acme\Lv\Component\Entity\Post;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * Post creation action representation.
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
     * Post creation method.
     *
     * @return Post
     */
    public function resolve()
    {
        // Api post call
        $response = $this->getRestApiClient()->post(
            array(),
            $this->serialize()
        );

        // parsing response
        $this->post = $this->getSerializer()->deserialize(
            (string) $response->getBody(),
            Post::class,
            'json'
        );

        return $this->post;
    }
}
