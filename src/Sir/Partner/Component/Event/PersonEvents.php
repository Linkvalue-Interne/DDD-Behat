<?php

namespace Sir\Partner\Component\Event;

/**
 * Person event reference class.
 */
final class PersonEvents
{
    /**
     * event fired when a person is created.
     */
    const SIR_PERSON_CREATED = 'sir.person.created';

    /**
     * event fired when a person is updated.
     */
    const SIR_PERSON_EDITED = 'sir.person.edited';

    /**
     * event fired when a person is deleted.
     */
    const SIR_PERSON_DELETED = 'sir.person.deleted';
}
