<?php

namespace Lv\Example\Component\Tests\Loader\Doctrine;

use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Entity\EntityCollection;
use Lv\Example\Component\Loader\Doctrine\EntityDoctrineLoader;
use Lv\Example\Component\Repository\EntityRepositoryInterface;

/**
 * Unit test class for Entity Doctrine loader class
 */
class EntityDoctrineLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests class creation
     */
    public function testConstruct()
    {
        $repository = $this->prophesize(EntityRepositoryInterface::class);
        $repository->save()->shouldNotBeCalled();

        $loader = new EntityDoctrineLoader();
        $loader->setUp(
            Entity::class,
            array('majora' => 'entity'),
            EntityCollection::class,
            $repository->reveal()
        );
    }
}
