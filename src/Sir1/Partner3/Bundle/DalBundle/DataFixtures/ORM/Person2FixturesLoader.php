<?php

namespace Sir1\Partner3\Bundle\DalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sir1\Partner3\Component\Entity\Person2;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Person2 fixtures loader.
 */
class Person2FixturesLoader extends AbstractFixture implements ContainerAwareInterface
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
        $person2Domain = $this->container->get('sir1.person2.domain');

        // reference there Person2s data you want to create
        $majoraEntities = array(
            // 'person2_1' => array(
            //      'hello' => 'world',
            //      'foo' => 'bar',
            // )
        );

        foreach ($majoraEntities as $reference => $person2Data) {
            $this->addReference(
                $reference,
                $person2Domain
                    ->getAction('create')
                    ->deserialize($person2Data)
                    ->resolve()
            );
        }
    }
}
