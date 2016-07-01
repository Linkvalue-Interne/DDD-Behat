<?php

namespace Test2\Test2\Component\Tests\Loader\Doctrine;

use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Entity\Test2Collection;
use Test2\Test2\Component\Loader\Doctrine\Test2DoctrineLoader;
use Test2\Test2\Component\Repository\Test2RepositoryInterface;

/**
 * Unit test class for Test2 Doctrine loader class
 */
class Test2DoctrineLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests class creation
     */
    public function testConstruct()
    {
        $repository = $this->prophesize(Test2RepositoryInterface::class);
        $repository->save()->shouldNotBeCalled();

        $loader = new Test2DoctrineLoader();
        $loader->setUp(
            Test2::class,
            array('majora' => 'entity'),
            Test2Collection::class,
            $repository->reveal()
        );
    }
}
