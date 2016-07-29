<?php

namespace Sir1\Partner3\Component\Tests\Action\Api\Person2;

use GuzzleHttp\Psr7\Response;
use Sir1\Partner3\Component\Action\Api\Person2\UpdateAction;
use Sir1\Partner3\Component\Entity\Person2;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Person2 UpdateAction throught Api.
 *
 * @see Sir1\Partner3\Component\Domain\Action\Api\Person2\UpdateAction
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
     *         'created_person2',
     *         'expected_person2_at_return',
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                (new Person2())->setId(42),
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
        Person2 $currentPerson2,
        array $incommingData,
        array $expectedRequestData
    ) {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->put(
                array('id' => $currentPerson2->getId()),
                $expectedRequestData
            )
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Action
        $action = new UpdateAction();
        $action->init($currentPerson2);
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $action->resolve();
    }
}
