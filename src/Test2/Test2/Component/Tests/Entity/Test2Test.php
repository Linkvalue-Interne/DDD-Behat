<?php

namespace Test2\Test2\Component\Tests\Entity;

use Test2\Test2\Component\Entity\Test2;

/**
 * Unit test class for Test2.
 *
 * @see Test2\Test2\Component\Entity\Test2
 */
class Test2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Test2
     */
    private $test2;

    /**
     * @var \ReflectionClass
     */
    private $reflector;

    /**
     * SetUp method.
     */
    public function setUp()
    {
        $this->test2 = new Test2();
        $this->reflector = new \ReflectionClass($this->test2);
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
        $this->test2->$method($definedValue);
        $this->assertEquals(
            $definedValue,
            $property->getValue($this->test2),
            sprintf('Test2::%s() defines "%s" property current value.',
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
        $property->setValue($this->test2, $expectedValue);

        $method = 'get'.ucfirst($propertyName);
        $this->assertEquals(
            $expectedValue,
            $this->test2->$method(),
            sprintf('Test2::%s() returns current defined "%s" property value.',
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
        $this->test2->setId(42);
        $test2Data = $this->test2->serialize($scope);

        if (!is_array($expectedKeys)) {
            return $this->assertInternalType(
                $expectedKeys,
                $test2Data,
                sprintf('Test2 "%s" scope provides a single value as %s.', $scope, $expectedKeys)
            );
        }

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey(
                $expectedKey,
                $test2Data,
                sprintf('Test2 "%s" scope provides an array with "%s" key.', $scope, $expectedKey)
            );
        }
    }
}
