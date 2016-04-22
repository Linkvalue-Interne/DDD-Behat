<?php

namespace Sir\Partner\Bundle\DalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sir\Partner\Component\Entity\Person;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Person fixtures loader.
 */
class PersonFixturesLoader extends AbstractFixture implements ContainerAwareInterface
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
        $personDomain = $this->container->get('sir.person.domain');

        // reference there Persons data you want to create
        $majoraEntities = array(
            // 'person_1' => array(
            //      'hello' => 'world',
            //      'foo' => 'bar',
            // )
        );

        foreach ($majoraEntities as $reference => $personData) {
            $this->addReference(
                $reference,
                $personDomain
                    ->getAction('create')
                    ->deserialize($personData)
                    ->resolve()
            );
        }
    }
}
