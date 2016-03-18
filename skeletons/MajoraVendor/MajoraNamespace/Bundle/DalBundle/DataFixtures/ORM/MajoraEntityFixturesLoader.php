<?php

namespace MajoraVendor\MajoraNamespace\Bundle\DalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * MajoraEntity fixtures loader.
 */
class MajoraEntityFixturesLoader extends AbstractFixture implements ContainerAwareInterface
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
        $majoraEntityDomain = $this->container->get('majora_vendor.majora_entity.domain');

        // reference there MajoraEntitys data you want to create
        $majoraEntities = array(
            // 'majora_entity_1' => array(
            //      'hello' => 'world',
            //      'foo' => 'bar',
            // )
        );

        foreach ($majoraEntities as $reference => $majoraEntityData) {
            $this->addReference(
                $reference,
                $majoraEntityDomain
                    ->getAction('create')
                    ->deserialize($majoraEntityData)
                    ->resolve()
            );
        }
    }
}
