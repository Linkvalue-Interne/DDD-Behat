<?php

namespace Sir\Partner\Bundle\DalBundle\Persistence;

use Sir\Partner\Component\Event\PersonEvent;
use Sir\Partner\Component\Event\PersonEvents;
use Sir\Partner\Component\Repository\PersonRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber on all Person events for persistence calls.
 */
class PersonPersistenceListener implements EventSubscriberInterface
{
    /**
     * @var PersonRepositoryInterface
     */
    protected $personRepository;

    /**
     * Construct.
     *
     * @param PersonRepositoryInterface $personRepository
     */
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    /**
     * @see EventSubscriberInterface::getSubscribedEvents()
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents()
    {
        return array(
            PersonEvents::SIR_PERSON_CREATED => array('onWritePerson', -100),
            PersonEvents::SIR_PERSON_EDITED => array('onWritePerson', -100),
            PersonEvents::SIR_PERSON_DELETED => array('onDeletePerson', -100),
        );
    }

    /**
     * Person writting event handler.
     *
     * @param PersonEvent $event
     */
    public function onWritePerson(PersonEvent $event)
    {
        $this->personRepository->persist(
            $event->getPerson()
        );
    }

    /**
     * Person deletion event handler.
     *
     * @param PersonEvent $event
     */
    public function onDeletePerson(PersonEvent $event)
    {
        $this->personRepository->remove(
            $event->getPerson()
        );
    }
}
