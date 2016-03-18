<?php

namespace MajoraVendor\MajoraNamespace\Component\Tests\Loader\Doctrine;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntityCollection;
use MajoraVendor\MajoraNamespace\Component\Loader\Doctrine\MajoraEntityDoctrineLoader;
use MajoraVendor\MajoraNamespace\Component\Repository\MajoraEntityRepositoryInterface;

/**
 * Unit test class for MajoraEntity Doctrine loader class
 */
class MajoraEntityDoctrineLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests class creation
     */
    public function testConstruct()
    {
        $repository = $this->prophesize(MajoraEntityRepositoryInterface::class);
        $repository->save()->shouldNotBeCalled();

        $loader = new MajoraEntityDoctrineLoader();
        $loader->setUp(
            MajoraEntity::class,
            array('majora' => 'entity'),
            MajoraEntityCollection::class,
            $repository->reveal()
        );
    }
}
