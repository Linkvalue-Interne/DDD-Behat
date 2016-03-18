<?php

namespace Acme\Lv\Component\Tests\Loader\Api;

use Acme\Lv\Component\Loader\Api\PostApiLoader;
use Majora\Framework\Api\Client\RestApiClient;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Unit test class for Post Api loader class.
 */
class PostApiLoaderTest extends \PHPUnit_Framework_TestCase
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

        $loader = new PostApiLoader(
            $restApiClient->reveal(),
            $serializer->reveal()
        );
    }
}
