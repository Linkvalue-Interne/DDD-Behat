<?php

namespace MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Features\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Context\Context;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntityCollection;
use MajoraVendor\MajoraNamespace\Component\Domain\MajoraEntityDomainInterface;
use MajoraVendor\MajoraNamespace\Component\Loader\MajoraEntityLoaderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class MajoraEntityDalDomainContext implements Context
{
    /**
     * @var MajoraEntityDomainInterface
     */
    protected $domain;

    /**
     * @var MajoraEntityLoaderInterface
     */
    protected $loader;

    /**
     * @var MajoraEntityCollection
     */
    protected $majora_entitys;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(
        MajoraEntityDomainInterface $domain,
        MajoraEntityLoaderInterface $loader,
        EntityManagerInterface $em)
    {
        $this->domain = $domain;
        $this->loader = $loader;
        $this->em = $em;

        $this->majora_entitys = new MajoraEntityCollection();
    }

    /**
     * @BeforeScenario
     */
    public function BeforeScenario()
    {
        $this->em->getConnection();
        $this->em->beginTransaction();
    }

    /**
     * @AfterScenario
     */
    public function AfterScenario()
    {
        $this->em->rollback();
        $this->em->close();
    }

    /**
     * @Given I have theses majora_entitys:
     */
    public function iHaveThesesMajoraEntitys(MajoraEntityCollection $majora_entitys)
    {
        // Fill majora_entitys table.
        foreach ($majora_entitys as $majora_entity) {
            $this->em->persist($majora_entity);
        }
        $this->em->flush();
        $this->majora_entitys = $majora_entitys;
    }

    /**
     * @Transform table:majora_entity_key,majora_entity_id
     * @Transform table:majora_entity_id
     */
    public function castMajoraEntitysTable(TableNode $majora_entitysTable)
    {
        $majora_entitys = new MajoraEntityCollection();
        foreach ($majora_entitysTable->getHash() as $majora_entityHash) {
            $majora_entity = new MajoraEntity();
            $majora_entity->setId($majora_entityHash['majora_entity_id']);
            if (isset($majora_entityHash['majora_entity_key'])) {
                $majora_entitys->set($majora_entityHash['majora_entity_key'], $majora_entity);
                continue;
            }
            $majora_entitys->add($majora_entity);
        }

        return $majora_entitys;
    }

    /**
     * @Given I get the majora_entity list
     */
    public function iGetTheMajoraEntityList()
    {
        $this->majora_entityList = $this->loader->retrieveAll();
    }

    /**
     * @Then I should see theses majora_entitys:
     * @Then I should see this majora_entity:
     */
    public function iShouldSeeThesesMajoraEntitys(MajoraEntityCollection $majora_entitys)
    {
        foreach ($majora_entitys as $majora_entity) {
            if (!$this->majora_entityList->search(['id' => $majora_entity->getId()])->count()) {
                $majora_entityId = $majora_entity->getId();
                throw new \Exception(sprintf('The majora_entity %s was not found.', $majora_entityId));
            }
        }
    }

    /**
     * @Then I should not see theses majora_entitys:
     * @Then I should not see this majora_entity:
     */
    public function iShouldNotSeeThesesMajoraEntitys(MajoraEntityCollection $majora_entitys)
    {
        foreach ($majora_entitys as $majora_entity) {
            if ($this->majora_entityList->search(['id' => $majora_entity->getId()])->count()) {
                $majora_entityId = $majora_entity->getId();
                throw new \Exception(sprintf('The majora_entity %s was found.', $majora_entityId));
            }
        }
    }

    /**
     * @Given I create this majora_entity:
     * @Given I create theses majora_entitys:
     */
    public function iCreateThisMajoraEntity(MajoraEntityCollection $majora_entitys)
    {
        foreach ($majora_entitys as $majora_entity) {
            $this->domain->create($majora_entity->serialize());
        }
    }

    /**
     * @Given I update the :key majora_entity with theses values:
     */
    public function iUpdateTheKeyMajoraEntity($key, MajoraEntityCollection $majora_entitys)
    {
        $oldMajoraEntity = $this->majora_entitys->get($key);

        if (!$oldMajoraEntity) {
            throw new \Exception(sprintf('The majora_entity %s was not found.', $key));
        }

        foreach ($majora_entitys as $majora_entity) {
            $this->domain->update($oldMajoraEntity, $majora_entity->serialize());
        }
    }

    /**
     * @Given I delete the :key majora_entity
     */
    public function iDeleteTheKeyMajoraEntity($key)
    {
        $oldMajoraEntity = $this->majora_entitys->get($key);

        if (!$oldMajoraEntity) {
            throw new \Exception(sprintf('The majora_entity %s was not found.', $key));
        }

        $this->domain->delete($oldMajoraEntity);
    }
}
