<?php

namespace Lv\Example\Component\Tests\Entity;

use Lv\Example\Component\Entity\Entity;

/**
 * Unit test class for Entity.
 *
 * @see Lv\Example\Component\Entity\Entity
 */
class EntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Entity
     */
    private $entity;

    /**
     * @var \ReflectionClass
     */
    private $reflector;

    /**
     * SetUp method.
     */
    public function setUp()
    {
        $this->entity = new Entity();
        $this->reflector = new \ReflectionClass($this->entity);
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
        $this->entity->$method($definedValue);
        $this->assertEquals(
            $definedValue,
            $property->getValue($this->entity),
            sprintf('Entity::%s() defines "%s" property current value.',
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
        $property->setValue($this->entity, $expectedValue);

        $method = 'get'.ucfirst($propertyName);
        $this->assertEquals(
            $expectedValue,
            $this->entity->$method(),
            sprintf('Entity::%s() returns current defined "%s" property value.',
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
        $this->entity->setId(42);
        $entityData = $this->entity->serialize($scope);

        if (!is_array($expectedKeys)) {
            return $this->assertInternalType(
                $expectedKeys,
                $entityData,
                sprintf('Entity "%s" scope provides a single value as %s.', $scope, $expectedKeys)
            );
        }

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey(
                $expectedKey,
                $entityData,
                sprintf('Entity "%s" scope provides an array with "%s" key.', $scope, $expectedKey)
            );
        }
    }
}
