<?php

namespace Acme\Lv\Component\Tests\Entity;

use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Entity\PostCollection;

/**
 * Unit test class for PostCollection.
 *
 * @see Acme\Lv\Component\Entity\PostCollection
 */
class PostCollectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests serialization process.
     */
    public function testSerialization()
    {
        $postCollection = new PostCollection();
        $postCollection->deserialize(array(
            'post_1' => array('id' => 42),
            'post_2' => array('id' => 66),
        ));

        $this->assertInstanceOf(
            Post::class,
            $postCollection->get('post_1'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertInstanceOf(
            Post::class,
            $postCollection->get('post_2'),
            'Deserialization process hydrate a related entity class object and index it under given key.'
        );
        $this->assertEquals(
            array(
                'post_1' => 42,
                'post_2' => 66,
            ),
            $postCollection->serialize('id'),
            'Serialization scopes are transmitted to related entity serialization process.'
        );
    }
}
