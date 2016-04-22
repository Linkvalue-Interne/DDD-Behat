<?php

namespace Sir\Partner\Component\Tests\Action\Api\Person;

use GuzzleHttp\Psr7\Response;
use Sir\Partner\Component\Action\Api\Person\DeleteAction;
use Sir\Partner\Component\Entity\Person;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Person DeleteAction throught Api.
 *
 * @see Sir\Partner\Component\Domain\Action\Api\Person\DeleteAction
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
        $action->init((new Person())->setId(42));
        $action->setRestApiClient($restClient->reveal());

        $action->resolve();
    }
}
