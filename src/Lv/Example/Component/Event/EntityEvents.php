<?php

namespace Lv\Example\Component\Event;

/**
 * Entity event reference class.
 */
final class EntityEvents
{
    /**
     * event fired when a entity is created.
     */
    const LV_ENTITY_CREATED = 'lv.entity.created';

    /**
     * event fired when a entity is updated.
     */
    const LV_ENTITY_EDITED = 'lv.entity.edited';

    /**
     * event fired when a entity is deleted.
     */
    const LV_ENTITY_DELETED = 'lv.entity.deleted';
}
