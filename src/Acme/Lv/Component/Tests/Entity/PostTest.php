<?php

namespace Acme\Lv\Component\Tests\Entity;

use Acme\Lv\Component\Entity\Post;

/**
 * Unit test class for Post.
 *
 * @see Acme\Lv\Component\Entity\Post
 */
class PostTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Post
     */
    private $post;

    /**
     * @var \ReflectionClass
     */
    private $reflector;

    /**
     * SetUp method.
     */
    public function setUp()
    {
        $this->post = new Post();
        $this->reflector = new \ReflectionClass($this->post);
    }

    /**
     * Provider for accessor tests.
     *
     * @return array
     */
    public function propertyMapProvider()
    {
        return array(
            'id' => array('id', 42),
        );
    }

    /**
     * Tests setters.
     *
     * @dataProvider propertyMapProvider
     */
    public function testSet($propertyName, $definedValue)
    {
        $property = $this->reflector->getProperty($propertyName);
        $property->setAccessible(true);

        $method = 'set'.ucfirst($propertyName);
        $this->post->$method($definedValue);
        $this->assertEquals(
            $definedValue,
            $property->getValue($this->post),
            sprintf('Post::%s() defines "%s" property current value.',
                $method,
                $propertyName
            )
        );
    }

    /**
     * Tests getters.
     *
     * @dataProvider propertyMapProvider
     */
    public function testGet($propertyName, $expectedValue)
    {
        $property = $this->reflector->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($this->post, $expectedValue);

        $method = 'get'.ucfirst($propertyName);
        $this->assertEquals(
            $expectedValue,
            $this->post->$method(),
            sprintf('Post::%s() returns current defined "%s" property value.',
                $method,
                $propertyName
            )
        );
    }

    /**
     * Provider for serialization tests.
     *
     * @return array()
     */
    public function serializationCasesProvider()
    {
        return array(
            'id' => array('id', 'int'),
            'default' => array('default', array('id')),
        );
    }

    /**
     * Tests serialization scopes.
     *
     * @dataProvider serializationCasesProvider
     */
    public function testSerializationScopes($scope, $expectedKeys)
    {
        $this->post->setId(42);
        $postData = $this->post->serialize($scope);

        if (!is_array($expectedKeys)) {
            return $this->assertInternalType(
                $expectedKeys,
                $postData,
                sprintf('Post "%s" scope provides a single value as %s.', $scope, $expectedKeys)
            );
        }

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey(
                $expectedKey,
                $postData,
                sprintf('Post "%s" scope provides an array with "%s" key.', $scope, $expectedKey)
            );
        }
    }
}
