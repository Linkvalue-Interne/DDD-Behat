<?php

namespace Lv\Example\Bundle\DalBundle\Persistence;

use Lv\Example\Component\Event\EntityEvent;
use Lv\Example\Component\Event\EntityEvents;
use Lv\Example\Component\Repository\EntityRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber on all Entity events for persistence calls.
 */
class EntityPersistenceListener implements EventSubscriberInterface
{
    /**
     * @var EntityRepositoryInterface
     */
    protected $entityRepository;

    /**
     * Construct.
     *
     * @param EntityRepositoryInterface $entityRepository
     */
    public function __construct(EntityRepositoryInterface $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /**
     * @see EventSubscriberInterface::getSubscribedEvents()
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents()
    {
        return array(
            EntityEvents::LV_ENTITY_CREATED => array('onWriteEntity', -100),
            EntityEvents::LV_ENTITY_EDITED => array('onWriteEntity', -100),
            EntityEvents::LV_ENTITY_DELETED => array('onDeleteEntity', -100),
        );
    }

    /**
     * Entity writting event handler.
     *
     * @param EntityEvent $event
     */
    public function onWriteEntity(EntityEvent $event)
    {
        $this->entityRepository->persist(
            $event->getEntity()
        );
    }

    /**
     * Entity deletion event handler.
     *
     * @param EntityEvent $event
     */
    public function onDeleteEntity(EntityEvent $event)
    {
        $this->entityRepository->remove(
            $event->getEntity()
        );
    }
}
