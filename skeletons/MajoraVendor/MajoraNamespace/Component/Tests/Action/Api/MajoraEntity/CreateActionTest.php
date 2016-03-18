<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Action\Api\MajoraEntity;

use GuzzleHttp\Psr7\Response;
use MajoraVendor\MajoraNamespace\Component\Action\Api\MajoraEntity\CreateAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Majora\Framework\Api\Client\RestApiClient;
use Prophecy\Argument;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for MajoraEntity CreateAction throught Api.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Domain\Action\Api\MajoraEntity\CreateAction
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
     *         'created_majora_entity',
     *         'expected_majora_entity_at_return',
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
                $majoraEntity = (new MajoraEntity())->setId(42),
                $majoraEntity,
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
        MajoraEntity $createdMajoraEntity,
        MajoraEntity $expectedMajoraEntity
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
            ->deserialize(Argument::any(), MajoraEntity::class, Argument::any())
            ->willReturn($createdMajoraEntity)
        ;

        // Action
        $action = new CreateAction();
        $action->setSerializer($serializer->reveal());
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedMajoraEntity,
            $action->resolve()
        );
    }
}
