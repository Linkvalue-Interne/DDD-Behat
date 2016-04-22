<?php

namespace Sir1\Partner3\Component\Tests\Loader\Api;

use Sir1\Partner3\Component\Loader\Api\Person2ApiLoader;
use Majora\Framework\Api\Client\RestApiClient;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Person2 Api loader class.
 */
class Person2ApiLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests class creation.
     */
    public function testConstruct()
    {
        $restApiClient = $this->prophesize(RestApiClient::class);
        $restApiClient->send()->shouldNotBeCalled();

        $serializer = $this->prophesize(SerializerInterface::class);
        $serializer->deserialize()->shouldNotBeCalled();

        $loader = new Person2ApiLoader(
            $restApiClient->reveal(),
            $serializer->reveal()
        );
    }
}
