<?php

namespace Lv\Example\Component\Tests\Action\Api\Entity;

use GuzzleHttp\Psr7\Response;
use Lv\Example\Component\Action\Api\Entity\CreateAction;
use Lv\Example\Component\Entity\Entity;
use Majora\Framework\Api\Client\RestApiClient;
use Prophecy\Argument;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Entity CreateAction throught Api.
 *
 * @see Lv\Example\Component\Domain\Action\Api\Entity\CreateAction
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
     *         'created_entity',
     *         'expected_entity_at_return',
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
                $entity = (new Entity())->setId(42),
                $entity,
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
        Entity $createdEntity,
        Entity $expectedEntity
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
            ->deserialize(Argument::any(), Entity::class, Argument::any())
            ->willReturn($createdEntity)
        ;

        // Action
        $action = new CreateAction();
        $action->setSerializer($serializer->reveal());
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedEntity,
            $action->resolve()
        );
    }
}
