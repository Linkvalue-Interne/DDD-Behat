<?php

namespace Test2\Test2\Component\Tests\Action\Api\Test2;

use GuzzleHttp\Psr7\Response;
use Test2\Test2\Component\Action\Api\Test2\CreateAction;
use Test2\Test2\Component\Entity\Test2;
use Majora\Framework\Api\Client\RestApiClient;
use Prophecy\Argument;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Test2 CreateAction throught Api.
 *
 * @see Test2\Test2\Component\Domain\Action\Api\Test2\CreateAction
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
                array(),
                array(),
                $test2 = (new Test2())->setId(42),
                $test2,
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
        Test2 $createdTest2,
        Test2 $expectedTest2
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
            ->deserialize(Argument::any(), Test2::class, Argument::any())
            ->willReturn($createdTest2)
        ;

        // Action
        $action = new CreateAction();
        $action->setSerializer($serializer->reveal());
        $action->setRestApiClient($restClient->reveal());
        $action->deserialize($incommingData);

        $this->assertEquals(
            $expectedTest2,
            $action->resolve()
        );
    }
}
