<?php

namespace Acme\Lv\Bundle\DalBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Acme\Lv\Component\Entity\Post;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Post fixtures loader.
 */
class PostFixturesLoader extends AbstractFixture implements ContainerAwareInterface
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
        $postDomain = $this->container->get('acme.post.domain');

        // reference there Posts data you want to create
        $majoraEntities = array(
            // 'post_1' => array(
            //      'hello' => 'world',
            //      'foo' => 'bar',
            // )
        );

        foreach ($majoraEntities as $reference => $postData) {
            $this->addReference(
                $reference,
                $postDomain
                    ->getAction('create')
                    ->deserialize($postData)
                    ->resolve()
            );
        }
    }
}
