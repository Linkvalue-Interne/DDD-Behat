<?php

namespace MajoraVendor\MajoraNamespace\Component\Event;

/**
 * MajoraEntity event reference class.
 */
final class MajoraEntityEvents
{
    /**
     * event fired when a majora_entity is created.
     */
    const MAJORA_VENDOR_MAJORA_ENTITY_CREATED = 'majora_vendor.majora_entity.created';

    /**
     * event fired when a majora_entity is updated.
     */
    const MAJORA_VENDOR_MAJORA_ENTITY_EDITED = 'majora_vendor.majora_entity.edited';

    /**
     * event fired when a majora_entity is deleted.
     */
    const MAJORA_VENDOR_MAJORA_ENTITY_DELETED = 'majora_vendor.majora_entity.deleted';
}
