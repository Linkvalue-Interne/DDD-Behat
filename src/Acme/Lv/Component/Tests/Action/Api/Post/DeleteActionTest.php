<?php

namespace Acme\Lv\Component\Tests\Action\Api\Post;

use GuzzleHttp\Psr7\Response;
use Acme\Lv\Component\Action\Api\Post\DeleteAction;
use Acme\Lv\Component\Entity\Post;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Post DeleteAction throught Api.
 *
 * @see Acme\Lv\Component\Domain\Action\Api\Post\DeleteAction
 * @see Symfony\Component\Serializer\SerializerInterface
 * @see Majora\Framework\Api\Client\RestApiClient
 */
class DeleteActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests resolve() function.
     */
    public function testResolve()
    {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->delete(array('id' => 42))
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Action
        $action = new DeleteAction();
        $action->init((new Post())->setId(42));
        $action->setRestApiClient($restClient->reveal());

        $action->resolve();
    }
}
