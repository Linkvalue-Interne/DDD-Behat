<?php

namespace Acme\Lv\Component\Tests\Loader\Doctrine;

use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Entity\PostCollection;
use Acme\Lv\Component\Loader\Doctrine\PostDoctrineLoader;
use Acme\Lv\Component\Repository\PostRepositoryInterface;

/**
 * Unit test class for Post Doctrine loader class
 */
class PostDoctrineLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests class creation
     */
    public function testConstruct()
    {
        $repository = $this->prophesize(PostRepositoryInterface::class);
        $repository->save()->shouldNotBeCalled();

        $loader = new PostDoctrineLoader();
        $loader->setUp(
            Post::class,
            array('majora' => 'entity'),
            PostCollection::class,
            $repository->reveal()
        );
    }
}
