<?php

namespace MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntityCollection;
use MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Features\Context\MajoraEntityApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class MajoraEntityContext implements Context
{

    private static $totalToInsert = 3;

    /**
    * @var UrlGeneratorInterface
    */
    protected $router;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var MajoraEntityCollection
     */
    protected $majora_entitys;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(
        UrlGeneratorInterface $router,
        EntityManagerInterface $em)
    {
        $this->router = $router;
        $this->em = $em;

        $this->client = new Client();
        $this->majora_entitys = new MajoraEntityCollection();
    }

    /**
     * @BeforeFeature
     */
    public function initMajoraEntitys()
    {
        $this->truncateMajoraEntitys();
        for($i=0; $i<= $this->totalToInsert; $i++){
            $this->em->persist(new MajoraEntity());
        }
    }

    /**
     * @AfterFeature
     */
    public function terminateMajoraEntitys()
    {
        $this->truncateMajoraEntitys();
    }

    /**
     * Trucate all table data
     * @throws \Doctrine\DBAL\DBALException
     */
    private function truncateMajoraEntitys(){
        $connection = $this->em->getConnection();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $this->em->createQuery('DELETE FROM MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity')->execute();
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }

}
