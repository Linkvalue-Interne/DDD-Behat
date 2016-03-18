<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Entity;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;

/**
 * Unit test class for MajoraEntity.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity
 */
class MajoraEntityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var MajoraEntity
     */
    private $majoraEntity;

    /**
     * @var \ReflectionClass
     */
    private $reflector;

    /**
     * SetUp method.
     */
    public function setUp()
    {
        $this->majoraEntity = new MajoraEntity();
        $this->reflector = new \ReflectionClass($this->majoraEntity);
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
        $this->majoraEntity->$method($definedValue);
        $this->assertEquals(
            $definedValue,
            $property->getValue($this->majoraEntity),
            sprintf('MajoraEntity::%s() defines "%s" property current value.',
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
        $property->setValue($this->majoraEntity, $expectedValue);

        $method = 'get'.ucfirst($propertyName);
        $this->assertEquals(
            $expectedValue,
            $this->majoraEntity->$method(),
            sprintf('MajoraEntity::%s() returns current defined "%s" property value.',
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
        $this->majoraEntity->setId(42);
        $majoraEntityData = $this->majoraEntity->serialize($scope);

        if (!is_array($expectedKeys)) {
            return $this->assertInternalType(
                $expectedKeys,
                $majoraEntityData,
                sprintf('MajoraEntity "%s" scope provides a single value as %s.', $scope, $expectedKeys)
            );
        }

        foreach ($expectedKeys as $expectedKey) {
            $this->assertArrayHasKey(
                $expectedKey,
                $majoraEntityData,
                sprintf('MajoraEntity "%s" scope provides an array with "%s" key.', $scope, $expectedKey)
            );
        }
    }
}
