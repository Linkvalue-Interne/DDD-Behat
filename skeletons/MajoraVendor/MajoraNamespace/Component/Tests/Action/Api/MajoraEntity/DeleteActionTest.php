<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Action\Api\MajoraEntity;

use GuzzleHttp\Psr7\Response;
use MajoraVendor\MajoraNamespace\Component\Action\Api\MajoraEntity\DeleteAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for MajoraEntity DeleteAction throught Api.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Domain\Action\Api\MajoraEntity\DeleteAction
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
        $action->init((new MajoraEntity())->setId(42));
        $action->setRestApiClient($restClient->reveal());

        $action->resolve();
    }
}
