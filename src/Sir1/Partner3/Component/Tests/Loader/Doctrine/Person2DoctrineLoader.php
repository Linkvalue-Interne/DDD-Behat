<?php

namespace Sir1\Partner3\Component\Tests\Loader\Doctrine;

use Sir1\Partner3\Component\Entity\Person2;
use Sir1\Partner3\Component\Entity\Person2Collection;
use Sir1\Partner3\Component\Loader\Doctrine\Person2DoctrineLoader;
use Sir1\Partner3\Component\Repository\Person2RepositoryInterface;

/**
 * Unit test class for Person2 Doctrine loader class
 */
class Person2DoctrineLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests class creation
     */
    public function testConstruct()
    {
        $repository = $this->prophesize(Person2RepositoryInterface::class);
        $repository->save()->shouldNotBeCalled();

        $loader = new Person2DoctrineLoader();
        $loader->setUp(
            Person2::class,
            array('majora' => 'entity'),
            Person2Collection::class,
            $repository->reveal()
        );
    }
}
