<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Entity;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntityCollection;

/**
 * Unit test class for MajoraEntityCollection.
 *
 * @see MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntityCollection
 */
class MajoraEntityCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests serialization process.
     */
    public function testSerialization()
    {
        $majoraEntityCollection = new MajoraEntityCollection();
        $majoraEntityCollection->deserialize(array(
            'majora_entity_1' => array('id' => 42),
            'majora_entity_2' => array('id' => 66),
        ));

        $this->assertInstanceOf(
            MajoraEntity::class,
            $majoraEntityCollection->get('majora_entity_1'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertInstanceOf(
            MajoraEntity::class,
            $majoraEntityCollection->get('majora_entity_2'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertEquals(
            array(
                'majora_entity_1' => 42,
                'majora_entity_2' => 66,
            ),
            $majoraEntityCollection->serialize('id'),
            'Serialization scopes are transmitted to related entity serialization process.'
        );
    }
}
