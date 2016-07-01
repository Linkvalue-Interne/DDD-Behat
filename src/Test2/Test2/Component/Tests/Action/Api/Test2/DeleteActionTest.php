<?php

namespace Test2\Test2\Component\Tests\Action\Api\Test2;

use GuzzleHttp\Psr7\Response;
use Test2\Test2\Component\Action\Api\Test2\DeleteAction;
use Test2\Test2\Component\Entity\Test2;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Test2 DeleteAction throught Api.
 *
 * @see Test2\Test2\Component\Domain\Action\Api\Test2\DeleteAction
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
        $action->init((new Test2())->setId(42));
        $action->setRestApiClient($restClient->reveal());

        $action->resolve();
    }
}
