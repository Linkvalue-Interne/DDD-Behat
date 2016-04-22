<?php

namespace Sir\Partner\Component\Tests\Loader\Doctrine;

use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Entity\PersonCollection;
use Sir\Partner\Component\Loader\Doctrine\PersonDoctrineLoader;
use Sir\Partner\Component\Repository\PersonRepositoryInterface;

/**
 * Unit test class for Person Doctrine loader class
 */
class PersonDoctrineLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests class creation
     */
    public function testConstruct()
    {
        $repository = $this->prophesize(PersonRepositoryInterface::class);
        $repository->save()->shouldNotBeCalled();

        $loader = new PersonDoctrineLoader();
        $loader->setUp(
            Person::class,
            array('majora' => 'entity'),
            PersonCollection::class,
            $repository->reveal()
        );
    }
}
