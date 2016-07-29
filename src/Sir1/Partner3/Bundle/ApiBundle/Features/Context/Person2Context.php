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
     * @var Person2
     */
    private $loadedPerson2;

    /**
     * @var Person2Collection
     */
    private $currentPerson2s;

    /**
     * @var int
     */
    private $memoryId;

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
        for($i=0; $i<= self::$totalToInsert; $i++){
            $this->em->persist(new Person2());
        }
        $this->em->flush();
    }

    /**
     * @Given I have some person2s
     *
     */
    public function retrieveSomePerson2s()
    {
        $this->person2s = $this->em->getRepository(Person2::class)->findAll();
    }

    /**
     * @Given I have created a new person2
     */
    public function insertPerson2()
    {
        $this->currentPerson2 = new Person2();
        $this->em->getRepository(Person2::class)->persist($this->currentPerson2);
        $this->em->flush();
        $this->em->refresh($this->currentPerson2);

        $this->memoryId = $this->currentPerson2->getId();
    }

    /**
     * @When I create a new person2
     */
    public function createPerson2()
    {
        $this->currentPerson2 = $this->domain->create(new Person2());
    }

    /**
     * @When I get the person2s list
     */
    public function getPerson2List()
    {
        $this->currentPerson2s = $this->loader->retrieveAll();
    }

    /**
     * @When I get this person2 by id
     */
    public function getPerson2()
    {
        $this->loadedPerson2 = $this->em->getRepository(Person2::class)->find($this->memoryId);
    }

    /**
     * @When I delete this person2
     */
    public function deletePerson2()
    {
        $this->domain->delete($this->currentPerson2);
    }

    /**
     * @When I update this person2 with a new id
     */
    public function updatePerson2()
    {
        $this->memoryId = $this->currentPerson2->getId();
        $this->domain->update($this->currentPerson2, array("id" => ($this->currentPerson2->getId() + 1)));
    }

    /**
     * @Then I retrieve new person2 id
     */
    public function testPerson2Id()
    {
        return $this->currentPerson2->getId() != null;
    }

    /**
     * @Then I should see a list of person2s
     */
    public function compareListPerson2s()
    {
        return $this->currentPerson2s === $this->person2s;
    }

    /**
     * @Then I should see this person2
     */
    public function comparePerson2()
    {
        return $this->loadedPerson2 === $this->currentPerson2;
    }

    /**
     * @Then I should not see this person2
     */
    public function checkPerson2Deleted()
    {
        return is_null($this->em->getRepository(Person2::class)->find($this->memoryId));
    }

    /**
     * @Then I should see the same person2 with this new id value
     */
    public function checkPerson2AsUpdated()
    {
        return $this->memoryId === $this->currentPerson2->getId() + 1;
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
