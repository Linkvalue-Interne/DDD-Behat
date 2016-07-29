<?php

namespace Sir1\Partner3\Component\Tests\Action\Api\Person2;

use GuzzleHttp\Psr7\Response;
use Sir1\Partner3\Component\Action\Api\Person2\CreateAction;
use Sir1\Partner3\Component\Entity\Person2;
use Majora\Framework\Api\Client\RestApiClient;
use Prophecy\Argument;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Person2 CreateAction throught Api.
 *
 * @see Sir1\Partner3\Component\Domain\Action\Api\Person2\CreateAction
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
                array(),
                array(),
                $person2 = (new Person2())->setId(42),
                $person2,
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
        Person2 $createdPerson2,
        Person2 $expectedPerson2
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
            ->deserialize(Argument::any(), Person2::class, Argument::any())
            ->willReturn($createdPerson2)
        ;

        // Action
        $action = new CreateAction();
        $action->setSerializer($serializer->reveal());
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedPerson2,
            $action->resolve()
        );
    }
}
