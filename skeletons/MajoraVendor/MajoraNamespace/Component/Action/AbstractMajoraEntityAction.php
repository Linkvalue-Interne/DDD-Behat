<?php

namespace MajoraVendor\MajoraNamespace\Component\Action;

use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Majora\Framework\Domain\Action\AbstractAction;

/**
 * Base class for MajoraEntityActions.
 *
 * @property $majoraEntity
 */
abstract class AbstractMajoraEntityAction extends AbstractAction
{
    /**
     * @var MajoraEntity
     */
    protected $majoraEntity;

    /**
     * Initialisation function.
     *
     * @param MajoraEntity $majoraEntity
     */
    public function init(MajoraEntity $majoraEntity = null)
    {
        $this->majoraEntity = $majoraEntity;

        return $this;
    }

    /**
     * Return related MajoraEntity if defined.
     *
     * @return MajoraEntity|null $majoraEntity
     */
    public function getMajoraEntity()
    {
        return $this->majoraEntity;
    }
}
