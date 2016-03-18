<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Loader\Api;

use MajoraVendor\MajoraNamespace\Component\Loader\Api\MajoraEntityApiLoader;
use Majora\Framework\Api\Client\RestApiClient;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for MajoraEntity Api loader class.
 */
class MajoraEntityApiLoaderTest extends \PHPUnit_Framework_TestCase
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

        $loader = new MajoraEntityApiLoader(
            $restApiClient->reveal(),
            $serializer->reveal()
        );
    }
}
