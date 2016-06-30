<?php

namespace MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntityCollection;
use MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Features\Context\MajoraEntityApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class MajoraEntityApiControllerContext implements Context
{

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
     * @AfterScenario
     */
    public function removeMajoraEntitys()
    {
        foreach ($this->majora_entitys as $majora_entity) {
            $this->em->remove($majora_entity);
        }
        $this->em->flush();
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
     * @Transform table:key,name
     * @Transform table:name
     */
    public function castMajoraEntitysTable(TableNode $majora_entitysTable)
    {
        $majora_entitys = new MajoraEntityCollection();
        foreach ($majora_entitysTable->getHash() as $majora_entityHash) {
            $majora_entity = new MajoraEntity();
            $majora_entity->setName($majora_entityHash['name']);
            if (isset($majora_entityHash['key'])) {
                $majora_entitys->set($majora_entityHash['key'], $majora_entity);
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
        $response = $this->client->request(
            'GET',
            $this->router->generate(
                'acme_api_majora_entity_collection',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            []
        );

        if ($response->getStatusCode() != Response::HTTP_OK) {
            throw new \Exception(
                sprintf(
                    'Wrong status code : %s given, %s expected',
                    $response->getStatusCode(),
                    Response::HTTP_OK
                )
            );
        }

        $data = json_decode($response->getBody()->getContents());
        $this->majora_entityList = new MajoraEntityCollection();
        $this->majora_entityList->denormalize($data);
    }

    /**
     * @Then I should see theses majora_entitys:
     * @Then I should see this majora_entity:
     */
    public function iShouldSeeThesesMajoraEntitys(MajoraEntityCollection $majora_entitys)
    {
        foreach ($majora_entitys as $majora_entity) {
            if (!$this->majora_entityList->search(['name' => $majora_entity->getName()])->count()) {
                $majora_entityName = $majora_entity->getName();
                throw new \Exception("The majora_entity $majora_entityName was not found.");
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
            if ($this->majora_entityList->search(['name' => $majora_entity->getName()])->count()) {
                $majora_entityName = $majora_entity->getName();
                throw new \Exception("The majora_entity $majora_entityName was found.");
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
            $response = $this->client->request(
                'POST',
                $this->router->generate(
                    'acme_api_majora_entity_create',
                    [],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                ['form_params' => $majora_entity->serialize()]
            );

            if ($response->getStatusCode() != Response::HTTP_CREATED) {
                throw new \Exception(
                    sprintf(
                        'Wrong status code : %s given, %s expected',
                        $response->getStatusCode(),
                        Response::HTTP_CREATED
                    )
                );
            }

            // Parse the answer and add the created majora_entity to the majora_entitylist so we can delete it after the scenario.
            $data = (array) json_decode($response->getBody()->getContents());
            $majora_entity->denormalize($data);
            $majora_entity = $this->em->getReference('MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity', $majora_entity->getId());
            $this->majora_entitys->add($majora_entity);
        }
    }

    /**
     * @Given I update the :key majora_entity with theses values:
     */
    public function iUpdateTheKeyMajoraEntity($key, MajoraEntityCollection $majora_entitys)
    {
        $oldMajoraEntity = $this->majora_entitys->get($key);

        if (!$oldMajoraEntity) {
            throw new \Exception("The majora_entity \"$key\" was not found.");
        }

        foreach ($majora_entitys as $majora_entity) {
            $response = $this->client->request(
                'PUT',
                $this->router->generate(
                    'acme_api_majora_entity_update',
                    ['id' => $oldMajoraEntity->getId()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                ['form_params' => $majora_entity->serialize()]
            );

            if ($response->getStatusCode() != Response::HTTP_NO_CONTENT) {
                throw new \Exception(
                    sprintf(
                        'Wrong status code : %s given, %s expected',
                        $response->getStatusCode(),
                        Response::HTTP_NO_CONTENT
                    )
                );
            }
        }
    }

    /**
     * @Given I delete the :key majora_entity
     */
    public function iDeleteTheKeyMajoraEntity($key)
    {
        $oldMajoraEntity = $this->majora_entitys->get($key);

        if (!$oldMajoraEntity) {
            throw new \Exception("The majora_entity \"$key\" was not found.");
        }

        $response = $this->client->request(
            'DELETE',
            $this->router->generate(
                'acme_api_majora_entity_delete',
                ['id' => $oldMajoraEntity->getId()],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            []
        );

        if ($response->getStatusCode() != Response::HTTP_NO_CONTENT) {
            throw new \Exception(
                sprintf(
                    'Wrong status code : %s given, %s expected',
                    $response->getStatusCode(),
                    Response::HTTP_NO_CONTENT
                )
            );
        }
    }
}
