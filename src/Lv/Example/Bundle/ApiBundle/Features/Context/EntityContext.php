<?php

namespace Lv\Example\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Lv\Example\Component\Entity\Entity;
use Lv\Example\Component\Entity\EntityCollection;
use Lv\Example\Component\Domain\EntityDomainInterface;
use Lv\Example\Component\Loader\EntityLoaderInterface;
use Lv\Example\Bundle\ApiBundle\Features\Context\EntityApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class EntityContext implements Context
{

    private static $totalToInsert = 3;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var EntityCollection
     */
    private $entitys;

    /**
     * @var Entity
     */
    private $currentEntity;

    /**
     * @var Entity
     */
    private $loadedEntity;

    /**
     * @var EntityCollection
     */
    private $currentEntitys;

    /**
     * @var int
     */
    private $memoryId;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityDomainInterface
     */
    protected $domain;

    /**
     * @var EntityLoaderInterface
     */
    protected $loader;

    public function __construct(
        EntityDomainInterface $domain,
        EntityLoaderInterface $loader,
        EntityManagerInterface $em
    ) {
        $this->em = $em;
        $this->domain = $domain;
        $this->loader = $loader;
    }

    /**
     * @BeforeScenario
     */
    public function initEntitys()
    {
        $this->truncateEntitys();
        for($i=0; $i<= self::$totalToInsert; $i++){
            $this->em->persist(new Entity());
        }
        $this->em->flush();
    }

    /**
     * @Given I have some entitys
     *
     */
    public function retrieveSomeEntitys()
    {
        $this->entitys = $this->em->getRepository(Entity::class)->findAll();
    }

    /**
     * @Given I have created a new entity
     */
    public function insertEntity()
    {
        $this->currentEntity = new Entity();
        $this->em->getRepository(Entity::class)->persist($this->currentEntity);
        $this->em->flush();
        $this->em->refresh($this->currentEntity);

        $this->memoryId = $this->currentEntity->getId();
    }

    /**
     * @When I create a new entity
     */
    public function createEntity()
    {
        $this->currentEntity = $this->domain->create(new Entity());
    }

    /**
     * @When I get the entitys list
     */
    public function getEntityList()
    {
        $this->currentEntitys = $this->loader->retrieveAll();
    }

    /**
     * @When I get this entity by id
     */
    public function getEntity()
    {
        $this->loadedEntity = $this->em->getRepository(Entity::class)->find($this->memoryId);
    }

    /**
     * @When I delete this entity
     */
    public function deleteEntity()
    {
        $this->domain->delete($this->currentEntity);
    }

    /**
     * @When I update this entity with a new id
     */
    public function updateEntity()
    {
        $this->memoryId = $this->currentEntity->getId();
        $this->domain->update($this->currentEntity, array("id" => ($this->currentEntity->getId() + 1)));
    }

    /**
     * @Then I retrieve new entity id
     */
    public function testEntityId()
    {
        return $this->currentEntity->getId() != null;
    }

    /**
     * @Then I should see a list of entitys
     */
    public function compareListEntitys()
    {
        return $this->currentEntitys === $this->entitys;
    }

    /**
     * @Then I should see this entity
     */
    public function compareEntity()
    {
        return $this->loadedEntity === $this->currentEntity;
    }

    /**
     * @Then I should not see this entity
     */
    public function checkEntityDeleted()
    {
        return is_null($this->em->getRepository(Entity::class)->find($this->memoryId));
    }

    /**
     * @Then I should see the same entity with this new id value
     */
    public function checkEntityAsUpdated()
    {
        return $this->memoryId === $this->currentEntity->getId() + 1;
    }

    /**
     * @AfterScenario
     */
    public function terminateEntitys()
    {
        $this->truncateEntitys();
    }

    /**
     * Trucate all table data
     * @throws \Doctrine\DBAL\DBALException
     */
    private function truncateEntitys()
    {
        $connection = $this->em->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $this->em->createQuery('DELETE FROM Lv\Example\Component\Entity\Entity')->execute();
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $this->em->flush();
    }

}
