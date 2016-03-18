<?php

namespace Acme\Lv\Component\Tests\Action\Api\Post;

use GuzzleHttp\Psr7\Response;
use Acme\Lv\Component\Action\Api\Post\UpdateAction;
use Acme\Lv\Component\Entity\Post;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Post UpdateAction throught Api.
 *
 * @see Acme\Lv\Component\Domain\Action\Api\Post\UpdateAction
 * @see Symfony\Component\Serializer\SerializerInterface
 * @see Majora\Framework\Api\Client\RestApiClient
 */
class UpdateActionTest extends \PHPUnit_Framework_TestCase
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
                (new Post())->setId(42),
                array(),
                array(),
            ),
        );
    }

    /**
     * Tests resolve() function.
     *
     * @dataProvider resolvingCasesProvider
     */
    public function testResolve(
        Post $currentPost,
        array $incommingData,
        array $expectedRequestData
    ) {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->put(
                array('id' => $currentPost->getId()),
                $expectedRequestData
            )
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Action
        $action = new UpdateAction();
        $action->init($currentPost);
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $action->resolve();
    }
}
