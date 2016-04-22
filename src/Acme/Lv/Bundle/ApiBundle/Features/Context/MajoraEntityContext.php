<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Doctrine\ORM\EntityManagerInterface;

abstract class MajoraEntityContext implements Context
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @BeforeSuite
     */
    public static function initDabatabase()
    {
        exec('php bin/console --env=test doctrine:schema:drop --force');
        exec('php bin/console --env=test doctrine:schema:create');
        // No use of fixtures, loaded in background.
        // exec('php bin/console --env=test doctrine:fixtures:load --no-interaction');
        echo 'Bdd initialized';
    }

}
