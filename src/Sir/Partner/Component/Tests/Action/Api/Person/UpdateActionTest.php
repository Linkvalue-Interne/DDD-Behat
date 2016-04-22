<?php

namespace Sir\Partner\Component\Tests\Action\Api\Person;

use GuzzleHttp\Psr7\Response;
use Sir\Partner\Component\Action\Api\Person\UpdateAction;
use Sir\Partner\Component\Entity\Person;
use Majora\Framework\Api\Client\RestApiClient;

/**
 * Unit test class for Person UpdateAction throught Api.
 *
 * @see Sir\Partner\Component\Domain\Action\Api\Person\UpdateAction
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
     *         'created_person',
     *         'expected_person_at_return',
     *     )
     *
     * @return array()
     */
    public function resolvingCasesProvider()
    {
        return array(
            'no_extra_fields_given' => array(
                (new Person())->setId(42),
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
        Person $currentPerson,
        array $incommingData,
        array $expectedRequestData
    ) {
        // Rest Client mock
        $restClient = $this->prophesize(RestApiClient::class);
        $restClient
            ->put(
                array('id' => $currentPerson->getId()),
                $expectedRequestData
            )
            ->willReturn(new Response())
            ->shouldBeCalled()
        ;

        // Action
        $action = new UpdateAction();
        $action->init($currentPerson);
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $action->resolve();
    }
}
