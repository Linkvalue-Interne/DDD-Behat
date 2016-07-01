<?php

namespace Test2\Test2\Component\Tests\Loader\Api;

use Test2\Test2\Component\Loader\Api\Test2ApiLoader;
use Majora\Framework\Api\Client\RestApiClient;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Test2 Api loader class.
 */
class Test2ApiLoaderTest extends \PHPUnit_Framework_TestCase
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

        $loader = new Test2ApiLoader(
            $restApiClient->reveal(),
            $serializer->reveal()
        );
    }
}
