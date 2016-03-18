<?php

namespace Acme\Lv\Bundle\DalBundle\Persistence;

use Acme\Lv\Component\Event\PostEvent;
use Acme\Lv\Component\Event\PostEvents;
use Acme\Lv\Component\Repository\PostRepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event subscriber on all Post events for persistence calls.
 */
class PostPersistenceListener implements EventSubscriberInterface
{
    /**
     * @var PostRepositoryInterface
     */
    protected $postRepository;

    /**
     * Construct.
     *
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    /**
     * @see EventSubscriberInterface::getSubscribedEvents()
     *
     * @codeCoverageIgnore
     */
    public static function getSubscribedEvents()
    {
        return array(
            PostEvents::ACME_POST_CREATED => array('onWritePost', -100),
            PostEvents::ACME_POST_EDITED => array('onWritePost', -100),
            PostEvents::ACME_POST_DELETED => array('onDeletePost', -100),
        );
    }

    /**
     * Post writting event handler.
     *
     * @param PostEvent $event
     */
    public function onWritePost(PostEvent $event)
    {
        $this->postRepository->persist(
            $event->getPost()
        );
    }

    /**
     * Post deletion event handler.
     *
     * @param PostEvent $event
     */
    public function onDeletePost(PostEvent $event)
    {
        $this->postRepository->remove(
            $event->getPost()
        );
    }
}
