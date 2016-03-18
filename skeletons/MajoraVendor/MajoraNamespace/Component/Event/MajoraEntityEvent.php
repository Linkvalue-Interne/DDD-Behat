<?php

namespace MajoraVendor\MajoraNamespace\Component\Event;

use MajoraVendor\MajoraNamespace\Component\Action\AbstractMajoraEntityAction;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Majora\Framework\Event\BroadcastableEvent;

/**
 * MajoraEntity specific event class.
 */
class MajoraEntityEvent extends BroadcastableEvent
{
    /**
     * @var MajoraEntity
     */
    protected $majoraEntity;

    /**
     * @var AbstractMajoraEntityAction
     */
    protected $action;

    /**
     * construct.
     *
     * @param MajoraEntity               $majoraEntity
     * @param AbstractMajoraEntityAction $action
     */
    public function __construct(MajoraEntity $majoraEntity, AbstractMajoraEntityAction $action = null)
    {
        $this->majoraEntity = $majoraEntity;
        $this->action = $action;
    }

    /**
     * return related.
     *
     * @return MajoraEntity
     */
    public function getMajoraEntity()
    {
        return $this->majoraEntity;
    }

    /**
     * @see BroadcastableEventInterface::getSubject()
     */
    public function getSubject()
    {
        return $this->getMajoraEntity();
    }

    /**
     * @see BroadcastableEventInterface::getAction()
     */
    public function getAction()
    {
        return $this->action;
    }
}
