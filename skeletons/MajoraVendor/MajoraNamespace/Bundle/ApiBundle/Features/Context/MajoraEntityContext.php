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
        MajoraEntityDomainInterface$loader,
        MajoraEntityLoaderInterface $domain,
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
        for($i=0; $i<= $this->totalToInsert; $i++){
            $this->em->persist(new MajoraEntity());
        }
        $this->em->flush();
    }

    /**
     * @When I create a new majora_entity
     */
    public function createMajoraEntity()
    {
        $this->currentMajoraEntity = $this->domain->create(new MajoraEntity());
    }

    /**
     * @Then I retrieve new majora_entity id
     */
    public function testMajoraEntityId()
    {
        var_dump($this->currentMajoraEntity);
        return $this->currentMajoraEntity->getId() != null;
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
