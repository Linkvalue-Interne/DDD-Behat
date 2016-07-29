<?php

namespace Sir1\Partner3\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Sir1\Partner3\Component\Entity\Person2;
use Sir1\Partner3\Component\Entity\Person2Collection;
use Sir1\Partner3\Component\Domain\Person2DomainInterface;
use Sir1\Partner3\Component\Loader\Person2LoaderInterface;
use Sir1\Partner3\Bundle\ApiBundle\Features\Context\Person2ApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class Person2Context implements Context
{

    private static $totalToInsert = 3;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var Person2Collection
     */
    private $person2s;


    /**
     * @var Person2
     */
    private $currentPerson2;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var Person2DomainInterface
     */
    protected $domain;

    /**
     * @var Person2LoaderInterface
     */
    protected $loader;

    public function __construct(
        Person2DomainInterface $domain,
        Person2LoaderInterface $loader,
        EntityManagerInterface $em
    ) {
        $this->em = $em;
        $this->domain = $domain;
        $this->loader = $loader;
    }

    /**
     * @BeforeScenario
     */
    public function initPerson2s()
    {
        $this->truncatePerson2s();
        for($i=0; $i<= $this->totalToInsert; $i++){
            $this->em->persist(new Person2());
        }
        $this->em->flush();
    }

    /**
     * @When I create a new person2
     */
    public function createPerson2()
    {
        $this->currentPerson2 = $this->domain->create(new Person2());
    }

    /**
     * @Then I retrieve new person2 id
     */
    public function testPerson2Id()
    {
        var_dump($this->currentPerson2);
        return $this->currentPerson2->getId() != null;
    }

    /**
     * @AfterScenario
     */
    public function terminatePerson2s()
    {
        $this->truncatePerson2s();
    }

    /**
     * Trucate all table data
     * @throws \Doctrine\DBAL\DBALException
     */
    private function truncatePerson2s()
    {
        $connection = $this->em->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $this->em->createQuery('DELETE FROM Sir1\Partner3\Component\Entity\Person2')->execute();
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $this->em->flush();
    }

}
