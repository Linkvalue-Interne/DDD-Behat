<?php

namespace Sir1\Partner3\Component\Tests\Entity;

use Sir1\Partner3\Component\Entity\Person2;

/**
 * Unit test class for Person2.
 *
 * @see Sir1\Partner3\Component\Entity\Person2
 */
class Person2Test extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Person2
     */
    private $person2;

    /**
     * @var \ReflectionClass
     */
    private $reflector;

    /**
     * SetUp method.
     */
    public function setUp()
    {
        $this->person2 = new Person2();
        $this->reflector = new \ReflectionClass($this->person2);
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
        $this->person2->$method($definedValue);
        $this->assertEquals(
            $definedValue,
            $property->getValue($this->person2),
            sprintf('Person2::%s() defines "%s" property current value.',
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
        $property->setValue($this->person2, $expectedValue);

        $method = 'get'.ucfirst($propertyName);
        $this->assertEquals(
            $expectedValue,
            $this->person2->$method(),
            sprintf('Person2::%s() returns current defined "%s" property value.',
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
        $this->person2->setId(42);
        $person2Data = $this->person2->serialize($scope);

        if (!is_array($expectedKeys)) {
            return $this->assertInternalType(
                $expectedKeys,
                $person2Data,
                sprintf('Person2 "%s" scope provides a single value as %s.', $scope, $expectedKeys)
            );
        }

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey(
                $expectedKey,
                $person2Data,
                sprintf('Person2 "%s" scope provides an array with "%s" key.', $scope, $expectedKey)
            );
        }
    }
}
