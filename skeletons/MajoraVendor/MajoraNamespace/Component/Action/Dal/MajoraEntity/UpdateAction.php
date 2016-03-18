<?php

namespace MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvents;
use Majora\Framework\Domain\Action\DynamicActionTrait;

/**
 * MajoraEntity edition action representation.
 */
class UpdateAction extends AbstractDalAction
{
    use DynamicActionTrait;

    /**
     * @see ActionInterface::resolve()
     */
    public function resolve()
    {
        $this->majoraEntity->deserialize($this->serialize());

        $this->assertEntityIsValid($this->majoraEntity, array('MajoraEntity', 'edition'));

        $this->fireEvent(
            MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_EDITED,
            new MajoraEntityEvent($this->majoraEntity, $this)
        );
    }
}
