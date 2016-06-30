<?php

namespace Sir\Partner\Component\Tests\Entity;

use Sir\Partner\Component\Entity\Person;

/**
 * Unit test class for Person.
 *
 * @see Sir\Partner\Component\Entity\Person
 */
class PersonTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Person
     */
    private $person;

    /**
     * @var \ReflectionClass
     */
    private $reflector;

    /**
     * SetUp method.
     */
    public function setUp()
    {
        $this->person = new Person();
        $this->reflector = new \ReflectionClass($this->person);
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
        $this->person->$method($definedValue);
        $this->assertEquals(
            $definedValue,
            $property->getValue($this->person),
            sprintf('Person::%s() defines "%s" property current value.',
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
        $property->setValue($this->person, $expectedValue);

        $method = 'get'.ucfirst($propertyName);
        $this->assertEquals(
            $expectedValue,
            $this->person->$method(),
            sprintf('Person::%s() returns current defined "%s" property value.',
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
        $this->person->setId(42);
        $personData = $this->person->serialize($scope);

        if (!is_array($expectedKeys)) {
            return $this->assertInternalType(
                $expectedKeys,
                $personData,
                sprintf('Person "%s" scope provides a single value as %s.', $scope, $expectedKeys)
            );
        }

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey(
                $expectedKey,
                $personData,
                sprintf('Person "%s" scope provides an array with "%s" key.', $scope, $expectedKey)
            );
        }
    }
}
