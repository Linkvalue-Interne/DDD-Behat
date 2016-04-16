<?php

namespace MajoraVendor\MajoraNamespace\Component\Action\Dal\MajoraEntity;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvent;
use MajoraVendor\MajoraNamespace\Component\Event\MajoraEntityEvents;

/**
 * MajoraEntity creation action representation.
 */
class CreateAction extends AbstractDalAction
{

    /**
     * MajoraEntity creation method.
     *
     * @return MajoraEntity
     */
    public function resolve()
    {
        $this->majoraEntity = new MajoraEntity();
        $this->majoraEntity->deserialize($this->serialize());

        $this->assertEntityIsValid($this->majoraEntity, array('MajoraEntity', 'creation'));

        $this->fireEvent(
            MajoraEntityEvents::MAJORA_VENDOR_MAJORA_ENTITY_CREATED,
            new MajoraEntityEvent($this->majoraEntity, $this)
        );

        return $this->majoraEntity;
    }
}
