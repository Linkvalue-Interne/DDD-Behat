<?php

namespace Lv\Example\Component\Tests\Action\Api\Entity;

use GuzzleHttp\Psr7\Response;
use Lv\Example\Component\Action\Api\Entity\UpdateAction;
use Lv\Example\Component\Entity\Entity;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Entity UpdateAction throught Api.
 *
 * @see Lv\Example\Component\Domain\Action\Api\Entity\UpdateAction
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
                (new Entity())->setId(42),
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
        Entity $currentEntity,
        array $incommingData,
        array $expectedRequestData
    ) {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->put(
                array('id' => $currentEntity->getId()),
                $expectedRequestData
            )
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Action
        $action = new UpdateAction();
        $action->init($currentEntity);
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $action->resolve();
    }
}
