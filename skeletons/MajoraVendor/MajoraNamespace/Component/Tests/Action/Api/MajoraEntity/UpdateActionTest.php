<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Action\Api\MajoraEntity;

use GuzzleHttp\Psr7\Response;
use MajoraVendor\MajoraNamespace\Component\Action\Api\MajoraEntity\UpdateAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for MajoraEntity UpdateAction throught Api.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Domain\Action\Api\MajoraEntity\UpdateAction
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
                (new MajoraEntity())->setId(42),
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
        MajoraEntity $currentMajoraEntity,
        array $incommingData,
        array $expectedRequestData
    ) {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->put(
                array('id' => $currentMajoraEntity->getId()),
                $expectedRequestData
            )
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Action
        $action = new UpdateAction();
        $action->init($currentMajoraEntity);
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $action->resolve();
    }
}
