<?php

namespace Lv\Example\Bundle\DalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Lv\Example\Component\Entity\Entity;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Entity fixtures loader.
 */
class EntityFixturesLoader extends AbstractFixture implements ContainerAwareInterface
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
        $entityDomain = $this->container->get('lv.entity.domain');

        // reference there Entitys data you want to create
        $majoraEntities = array(
            // 'entity_1' => array(
            //      'hello' => 'world',
            //      'foo' => 'bar',
            // )
        );

        foreach ($majoraEntities as $reference => $entityData) {
            $this->addReference(
                $reference,
                $entityDomain
                    ->getAction('create')
                    ->deserialize($entityData)
                    ->resolve()
            );
        }
    }
}
