<?php

namespace Sir\Partner\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Entity\PersonCollection;
use Sir\Partner\Bundle\ApiBundle\Features\Context\PersonApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class PersonApiControllerContext implements Context
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
     * @var PersonCollection
     */
    protected $persons;

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
        $this->persons = new PersonCollection();
    }

    /**
     * @AfterScenario
     */
    public function removePersons()
    {
        foreach ($this->persons as $person) {
            $this->em->remove($person);
        }
        $this->em->flush();
    }

    /**
     * @Given I have theses persons:
     */
    public function iHaveThesesPersons(PersonCollection $persons)
    {
        // Fill persons table.
        foreach ($persons as $person) {
            $this->em->persist($person);
        }
        $this->em->flush();
        $this->persons = $persons;
    }

    /**
     * @Transform table:key,name
     * @Transform table:name
     */
    public function castPersonsTable(TableNode $personsTable)
    {
        $persons = new PersonCollection();
        foreach ($personsTable->getHash() as $personHash) {
            $person = new Person();
            $person->setName($personHash['name']);
            if (isset($personHash['key'])) {
                $persons->set($personHash['key'], $person);
                continue;
            }
            $persons->add($person);
        }

        return $persons;
    }

    /**
     * @Given I get the person list
     */
    public function iGetThePersonList()
    {
        $response = $this->client->request(
            'GET',
            $this->router->generate(
                'acme_api_person_collection',
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
        $this->personList = new PersonCollection();
        $this->personList->denormalize($data);
    }

    /**
     * @Then I should see theses persons:
     * @Then I should see this person:
     */
    public function iShouldSeeThesesPersons(PersonCollection $persons)
    {
        foreach ($persons as $person) {
            if (!$this->personList->search(['name' => $person->getName()])->count()) {
                $personName = $person->getName();
                throw new \Exception("The person $personName was not found.");
            }
        }
    }

    /**
     * @Then I should not see theses persons:
     * @Then I should not see this person:
     */
    public function iShouldNotSeeThesesPersons(PersonCollection $persons)
    {
        foreach ($persons as $person) {
            if ($this->personList->search(['name' => $person->getName()])->count()) {
                $personName = $person->getName();
                throw new \Exception("The person $personName was found.");
            }
        }
    }

    /**
     * @Given I create this person:
     * @Given I create theses persons:
     */
    public function iCreateThisPerson(PersonCollection $persons)
    {
        foreach ($persons as $person) {
            $response = $this->client->request(
                'POST',
                $this->router->generate(
                    'acme_api_person_create',
                    [],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                ['form_params' => $person->serialize()]
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

            // Parse the answer and add the created person to the personlist so we can delete it after the scenario.
            $data = (array) json_decode($response->getBody()->getContents());
            $person->denormalize($data);
            $person = $this->em->getReference('Sir\Partner\Component\Entity\Person', $person->getId());
            $this->persons->add($person);
        }
    }

    /**
     * @Given I update the :key person with theses values:
     */
    public function iUpdateTheKeyPerson($key, PersonCollection $persons)
    {
        $oldPerson = $this->persons->get($key);

        if (!$oldPerson) {
            throw new \Exception("The person \"$key\" was not found.");
        }

        foreach ($persons as $person) {
            $response = $this->client->request(
                'PUT',
                $this->router->generate(
                    'acme_api_person_update',
                    ['id' => $oldPerson->getId()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                ['form_params' => $person->serialize()]
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
     * @Given I delete the :key person
     */
    public function iDeleteTheKeyPerson($key)
    {
        $oldPerson = $this->persons->get($key);

        if (!$oldPerson) {
            throw new \Exception("The person \"$key\" was not found.");
        }

        $response = $this->client->request(
            'DELETE',
            $this->router->generate(
                'acme_api_person_delete',
                ['id' => $oldPerson->getId()],
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
