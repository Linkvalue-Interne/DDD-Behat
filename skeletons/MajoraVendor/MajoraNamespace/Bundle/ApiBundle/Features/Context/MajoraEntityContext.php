<?php

namespace MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntityCollection;
use MajoraVendor\MajoraNamespace\Component\Domain\MajoraEntityDomainInterface;
use MajoraVendor\MajoraNamespace\Component\Loader\MajoraEntityLoaderInterface;
use MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Features\Context\MajoraEntityApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class MajoraEntityContext implements Context
{

    private static $totalToInsert = 3;

    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var MajoraEntityCollection
     */
    private $majora_entitys;

    /**
     * @var MajoraEntity
     */
    private $currentMajoraEntity;

    /**
     * @var MajoraEntityCollection
     */
    private $currentMajoraEntitys;

    /**
     * @var int
     */
    private $memoryId;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var MajoraEntityDomainInterface
     */
    protected $domain;

    /**
     * @var MajoraEntityLoaderInterface
     */
    protected $loader;

    public function __construct(
        MajoraEntityDomainInterface $domain,
        MajoraEntityLoaderInterface $loader,
        EntityManagerInterface $em
    ) {
        $this->em = $em;
        $this->domain = $domain;
        $this->loader = $loader;
    }

    /**
     * @BeforeScenario
     */
    public function initMajoraEntitys()
    {
        $this->truncateMajoraEntitys();
        for($i=0; $i<= self::$totalToInsert; $i++){
            $this->em->persist(new MajoraEntity());
        }
        $this->em->flush();
    }

    /**
     * @Given I have some majora_entitiys
     *
     */
    public function retrieveSomeMajoraEntitys()
    {
        $this->majora_entitys = $this->em->getRepository(MajoraEntity::class)->findAll();
    }

    /**
     * @Given I have created a new majora_entity
     */
    public function insertMajoraEntity()
    {
        $this->currentMajoraEntity = new MajoraEntity();
        $this->em->getRepository(MajoraEntity::class)->persist($this->currentMajoraEntity);
        $this->em->flush();
        $this->em->refresh($this->currentMajoraEntity);

        $this->memoryId = $this->currentMajoraEntity->getId();
    }

    /**
     * @When I create a new majora_entity
     */
    public function createMajoraEntity()
    {
        $this->currentMajoraEntity = $this->domain->create(new MajoraEntity());
    }

    /**
     * @When I get the majora_entitys list
     */
    public function getMajoraEntityList()
    {
        $this->currentMajoraEntitys = $this->loader->retrieveAll();
    }

    /**
     * @When I delete this majora_entity
     */
    public function deleteMajoraEntity()
    {
        $this->domain->delete($this->currentMajoraEntity);
    }

    /**
     * @Then I retrieve new majora_entity id
     */
    public function testMajoraEntityId()
    {
        return $this->currentMajoraEntity->getId() != null;
    }

    /**
     * @Then I should see a list of majora_entitys
     */
    public function compareListMajoraEntitys()
    {
        return $this->currentMajoraEntitys === $this->majora_entitys;
    }

    /**
     * @Then I should not see this majora_entity
     */
    public function checkMajoraEntityDeleted()
    {
        return is_null($this->em->getRepository(MajoraEntity::class)->find($this->memoryId));
    }

    /**
     * @AfterScenario
     */
    public function terminateMajoraEntitys()
    {
        $this->truncateMajoraEntitys();
    }

    /**
     * Trucate all table data
     * @throws \Doctrine\DBAL\DBALException
     */
    private function truncateMajoraEntitys()
    {
        $connection = $this->em->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $this->em->createQuery('DELETE FROM MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity')->execute();
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
        $this->em->flush();
    }

}
