<?php

namespace Test2\Test2\Bundle\DalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Test2\Test2\Component\Entity\Test2;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Test2 fixtures loader.
 */
class Test2FixturesLoader extends AbstractFixture implements ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @see ContainerAwareInterface::setContainer()
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @see FixtureInterface::load()
     */
    public function load(ObjectManager $manager)
    {
        $test2Domain = $this->container->get('test2.test2.domain');

        // reference there Test2s data you want to create
        $majoraEntities = array(
            // 'test2_1' => array(
            //      'hello' => 'world',
            //      'foo' => 'bar',
            // )
        );

        foreach ($majoraEntities as $reference => $test2Data) {
            $this->addReference(
                $reference,
                $test2Domain
                    ->getAction('create')
                    ->deserialize($test2Data)
                    ->resolve()
            );
        }
    }
}
