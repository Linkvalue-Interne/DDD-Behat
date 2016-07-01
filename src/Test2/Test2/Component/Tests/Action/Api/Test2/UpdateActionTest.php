<?php

namespace Test2\Test2\Component\Tests\Action\Api\Test2;

use GuzzleHttp\Psr7\Response;
use Test2\Test2\Component\Action\Api\Test2\UpdateAction;
use Test2\Test2\Component\Entity\Test2;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Test2 UpdateAction throught Api.
 *
 * @see Test2\Test2\Component\Domain\Action\Api\Test2\UpdateAction
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
     *         'created_test2',
     *         'expected_test2_at_return',
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                (new Test2())->setId(42),
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
        Test2 $currentTest2,
        array $incommingData,
        array $expectedRequestData
    ) {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->put(
                array('id' => $currentTest2->getId()),
                $expectedRequestData
            )
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Action
        $action = new UpdateAction();
        $action->init($currentTest2);
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $action->resolve();
    }
}
