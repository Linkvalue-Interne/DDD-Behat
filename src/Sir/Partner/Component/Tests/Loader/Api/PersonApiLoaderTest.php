<?php

namespace Sir\Partner\Component\Tests\Loader\Api;

use Sir\Partner\Component\Loader\Api\PersonApiLoader;
use Majora\Framework\Api\Client\RestApiClient;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Person Api loader class.
 */
class PersonApiLoaderTest extends \PHPUnit_Framework_TestCase
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

        $loader = new PersonApiLoader(
            $restApiClient->reveal(),
            $serializer->reveal()
        );
    }
}
