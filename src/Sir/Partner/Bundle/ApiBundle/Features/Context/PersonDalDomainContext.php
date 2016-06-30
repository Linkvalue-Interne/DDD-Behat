<?php

namespace Sir\Partner\Bundle\ApiBundle\Features\Context;

use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Context\Context;
use Sir\Partner\Component\Entity\Person;
use Sir\Partner\Component\Entity\PersonCollection;
use Sir\Partner\Component\Domain\PersonDomainInterface;
use Sir\Partner\Component\Loader\PersonLoaderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class PersonDalDomainContext implements Context
{
    /**
     * @var PersonDomainInterface
     */
    protected $domain;

    /**
     * @var PersonLoaderInterface
     */
    protected $loader;

    /**
     * @var PersonCollection
     */
    protected $persons;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(
        PersonDomainInterface $domain,
        PersonLoaderInterface $loader,
        EntityManagerInterface $em)
    {
        $this->domain = $domain;
        $this->loader = $loader;
        $this->em = $em;

        $this->persons = new PersonCollection();
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
     * @Transform table:person_key,person_id
     * @Transform table:person_id
     */
    public function castPersonsTable(TableNode $personsTable)
    {
        $persons = new PersonCollection();
        foreach ($personsTable->getHash() as $personHash) {
            $person = new Person();
            $person->setId($personHash['person_id']);
            if (isset($personHash['person_key'])) {
                $persons->set($personHash['person_key'], $person);
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
        $this->personList = $this->loader->retrieveAll();
    }

    /**
     * @Then I should see theses persons:
     * @Then I should see this person:
     */
    public function iShouldSeeThesesPersons(PersonCollection $persons)
    {
        foreach ($persons as $person) {
            if (!$this->personList->search(['id' => $person->getId()])->count()) {
                $personId = $person->getId();
                throw new \Exception(sprintf('The person %s was not found.', $personId));
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
            if ($this->personList->search(['id' => $person->getId()])->count()) {
                $personId = $person->getId();
                throw new \Exception(sprintf('The person %s was found.', $personId));
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
            $this->domain->create($person->serialize());
        }
    }

    /**
     * @Given I update the :key person with theses values:
     */
    public function iUpdateTheKeyPerson($key, PersonCollection $persons)
    {
        $oldPerson = $this->persons->get($key);

        if (!$oldPerson) {
            throw new \Exception(sprintf('The person %s was not found.', $key));
        }

        foreach ($persons as $person) {
            $this->domain->update($oldPerson, $person->serialize());
        }
    }

    /**
     * @Given I delete the :key person
     */
    public function iDeleteTheKeyPerson($key)
    {
        $oldPerson = $this->persons->get($key);

        if (!$oldPerson) {
            throw new \Exception(sprintf('The person %s was not found.', $key));
        }

        $this->domain->delete($oldPerson);
    }
}
