<?php

namespace Test2\Test2\Component\Tests\Entity;

use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Entity\Test2Collection;

/**
 * Unit test class for Test2Collection.
 *
 * @see Test2\Test2\Component\Entity\Test2Collection
 */
class Test2CollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests serialization process.
     */
    public function testSerialization()
    {
        $test2Collection = new Test2Collection();
        $test2Collection->deserialize(array(
            'test2_1' => array('id' => 42),
            'test2_2' => array('id' => 66),
        ));

        $this->assertInstanceOf(
            Test2::class,
            $test2Collection->get('test2_1'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertInstanceOf(
            Test2::class,
            $test2Collection->get('test2_2'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertEquals(
            array(
                'test2_1' => 42,
                'test2_2' => 66,
            ),
            $test2Collection->serialize('id'),
            'Serialization scopes are transmitted to related entity serialization process.'
        );
    }
}
