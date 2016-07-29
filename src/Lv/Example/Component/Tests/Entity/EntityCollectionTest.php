<?php

namespace Lv\Example\Component\Tests\Entity;

use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Entity\EntityCollection;

/**
 * Unit test class for EntityCollection.
 *
 * @see Lv\Example\Component\Entity\EntityCollection
 */
class EntityCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests serialization process.
     */
    public function testSerialization()
    {
        $entityCollection = new EntityCollection();
        $entityCollection->deserialize(array(
            'entity_1' => array('id' => 42),
            'entity_2' => array('id' => 66),
        ));

        $this->assertInstanceOf(
            Entity::class,
            $entityCollection->get('entity_1'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertInstanceOf(
            Entity::class,
            $entityCollection->get('entity_2'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertEquals(
            array(
                'entity_1' => 42,
                'entity_2' => 66,
            ),
            $entityCollection->serialize('id'),
            'Serialization scopes are transmitted to related entity serialization process.'
        );
    }
}
