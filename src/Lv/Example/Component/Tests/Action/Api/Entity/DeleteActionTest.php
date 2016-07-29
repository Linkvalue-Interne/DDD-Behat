<?php

namespace Lv\Example\Component\Tests\Action\Api\Entity;

use GuzzleHttp\Psr7\Response;
use Lv\Example\Component\Action\Api\Entity\DeleteAction;
use Lv\Example\Component\Entity\Entity;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Entity DeleteAction throught Api.
 *
 * @see Lv\Example\Component\Domain\Action\Api\Entity\DeleteAction
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
        $action->init((new Entity())->setId(42));
        $action->setRestApiClient($restClient->reveal());

        $action->resolve();
    }
}
