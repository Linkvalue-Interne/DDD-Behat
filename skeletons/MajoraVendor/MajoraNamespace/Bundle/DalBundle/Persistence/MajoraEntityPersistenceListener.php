<?php

namespace MajoraVendor\MajoraNamespace\Bundle\DalBundle\Persistence;

use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvents;
use MajoraVendor\MajoraNamespace\Component\Repository\MajoraEntityRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber on all MajoraEntity events for persistence calls.
 */
class MajoraEntityPersistenceListener implements EventSubscriberInterface
{
    /**
     * @var MajoraEntityRepositoryInterface
     */
    protected $majoraEntityRepository;

    /**
     * Construct.
     *
     * @param MajoraEntityRepositoryInterface $majoraEntityRepository
     */
    public function __construct(MajoraEntityRepositoryInterface $majoraEntityRepository)
    {
        $this->majoraEntityRepository = $majoraEntityRepository;
    }

    /**
     * @see EventSubscriberInterface::getSubscribedEvents()
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents()
    {
        return array(
            MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_CREATED => array('onWriteMajoraEntity', -100),
            MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_EDITED => array('onWriteMajoraEntity', -100),
            MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_DELETED => array('onDeleteMajoraEntity', -100),
        );
    }

    /**
     * MajoraEntity writting event handler.
     *
     * @param MajoraEntityEvent $event
     */
    public function onWriteMajoraEntity(MajoraEntityEvent $event)
    {
        $this->majoraEntityRepository->persist(
            $event->getMajoraEntity()
        );
    }

    /**
     * MajoraEntity deletion event handler.
     *
     * @param MajoraEntityEvent $event
     */
    public function onDeleteMajoraEntity(MajoraEntityEvent $event)
    {
        $this->majoraEntityRepository->remove(
            $event->getMajoraEntity()
        );
    }
}
