<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Doctrine\ORM\EntityManagerInterface;

abstract class MajoraEntityDalContext extends MajoraEntityContext
{
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

}
