<?php

namespace Sir1\Partner3\Component\Tests\Action\Api\Person2;

use GuzzleHttp\Psr7\Response;
use Sir1\Partner3\Component\Action\Api\Person2\DeleteAction;
use Sir1\Partner3\Component\Entity\Person2;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Person2 DeleteAction throught Api.
 *
 * @see Sir1\Partner3\Component\Domain\Action\Api\Person2\DeleteAction
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
        $action->init((new Person2())->setId(42));
        $action->setRestApiClient($restClient->reveal());

        $action->resolve();
    }
}
