<?php

namespace Test2\Test2\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Test2\Test2\Component\Entity\Test2;
use Test2\Test2\Component\Entity\Test2Collection;
use Test2\Test2\Component\Domain\Test2DomainInterface;
use Test2\Test2\Component\Loader\Test2LoaderInterface;
use Test2\Test2\Bundle\ApiBundle\Features\Context\Test2ApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class Test2Context implements Context
{

    private static $totalToInsert = 3;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Test2Collection
     */
    private $test2s;


    /**
     * @var Test2
     */
    private $currentTest2;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var Test2DomainInterface
     */
    protected $domain;

    /**
     * @var Test2LoaderInterface
     */
    protected $loader;

    public function __construct(
        Test2LoaderInterface $domain,
        Test2DomainInterface$loader,
        EntityManagerInterface $em
    ) {
        $this->em = $em;
        $this->domain = $domain;
        $this->loader = $loader;
    }

    /**
     * @BeforeFeature
     */
    public static function initTest2s()
    {
        self::truncateTest2s();
        for($i=0; $i<= $this->totalToInsert; $i++){
            $this->em->persist(new Test2());
        }
        $this->em->flush();
    }

    /**
     * @When I create a new test2
     */
    public function createTest2()
    {
        $this->currentTest2 = $this->domain->create(new Test2());
    }

    /**
     * @Then I retrieve new test2 id
     */
    public function testTest2Id()
    {
        var_dump($this->currentTest2);
        return $this->currentTest2->getId() != null;
    }

    /**
     * @AfterFeature
     */
    public static function terminateTest2s()
    {
        self::truncateTest2s();
    }

    /**
     * Trucate all table data
     * @throws \Doctrine\DBAL\DBALException
     */
    private static function truncateTest2s()
    {
        $connection = $this->em->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $this->em->createQuery('DELETE FROM Test2\Test2\Component\Entity\Test2')->execute();
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $this->em->flush();
    }

}
