<?php

namespace Lv\Example\Component\Tests\Loader\Api;

use Lv\Example\Component\Loader\Api\EntityApiLoader;
use Majora\Framework\Api\Client\RestApiClient;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Entity Api loader class.
 */
class EntityApiLoaderTest extends \PHPUnit_Framework_TestCase
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

        $loader = new EntityApiLoader(
            $restApiClient->reveal(),
            $serializer->reveal()
        );
    }
}
