<?php

namespace Sir1\Partner3\Component\Tests\Entity;

use Sir1\Partner3\Component\Entity\Person2;
use Sir1\Partner3\Component\Entity\Person2Collection;

/**
 * Unit test class for Person2Collection.
 *
 * @see Sir1\Partner3\Component\Entity\Person2Collection
 */
class Person2CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests serialization process.
     */
    public function testSerialization()
    {
        $person2Collection = new Person2Collection();
        $person2Collection->deserialize(array(
            'person2_1' => array('id' => 42),
            'person2_2' => array('id' => 66),
        ));

        $this->assertInstanceOf(
            Person2::class,
            $person2Collection->get('person2_1'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertInstanceOf(
            Person2::class,
            $person2Collection->get('person2_2'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertEquals(
            array(
                'person2_1' => 42,
                'person2_2' => 66,
            ),
            $person2Collection->serialize('id'),
            'Serialization scopes are transmitted to related entity serialization process.'
        );
    }
}
