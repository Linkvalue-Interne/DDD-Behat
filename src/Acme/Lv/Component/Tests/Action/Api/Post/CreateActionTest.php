<?php

namespace Acme\Lv\Component\Tests\Action\Api\Post;

use GuzzleHttp\Psr7\Response;
use Acme\Lv\Component\Action\Api\Post\CreateAction;
use Acme\Lv\Component\Entity\Post;
use Majora\Framework\Api\Client\RestApiClient;
use Prophecy\Argument;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Post CreateAction throught Api.
 *
 * @see Acme\Lv\Component\Domain\Action\Api\Post\CreateAction
 * @see Symfony\Component\Serializer\SerializerInterface
 * @see Majora\Framework\Api\Client\RestApiClient
 */
class CreateActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Provides use cases to resolve() function tests.
     *
     * @example
     *     array(
     *         'action_members_as_associative',
     *         'expected_post_request_body_data_as_array',
     *         'created_post',
     *         'expected_post_at_return',
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                array(),
                array(),
                $post = (new Post())->setId(42),
                $post,
            ),

        );
    }

    /**
     * Tests resolve() function.
     *
     * @dataProvider resolvingCasesProvider
     */
    public function testResolve(
        array $incommingData,
        array $expectedRequestData,
        Post $createdPost,
        Post $expectedPost
    ) {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->post(array(), $expectedRequestData)
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Serializer mock
        $serializer = $this->prophesize(SerializerInterface::class);
        $serializer
            ->deserialize(Argument::any(), Post::class, Argument::any())
            ->willReturn($createdPost)
        ;

        // Action
        $action = new CreateAction();
        $action->setSerializer($serializer->reveal());
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedPost,
            $action->resolve()
        );
    }
}
