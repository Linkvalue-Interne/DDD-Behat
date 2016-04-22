<?php

namespace Sir\Partner\Component\Tests\Entity;

use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Entity\PersonCollection;

/**
 * Unit test class for PersonCollection.
 *
 * @see Sir\Partner\Component\Entity\PersonCollection
 */
class PersonCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests serialization process.
     */
    public function testSerialization()
    {
        $personCollection = new PersonCollection();
        $personCollection->deserialize(array(
            'person_1' => array('id' => 42),
            'person_2' => array('id' => 66),
        ));

        $this->assertInstanceOf(
            Person::class,
            $personCollection->get('person_1'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertInstanceOf(
            Person::class,
            $personCollection->get('person_2'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertEquals(
            array(
                'person_1' => 42,
                'person_2' => 66,
            ),
            $personCollection->serialize('id'),
            'Serialization scopes are transmitted to related entity serialization process.'
        );
    }
}
