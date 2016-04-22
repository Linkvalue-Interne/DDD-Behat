<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Entity\PostCollection;
use Acme\Lv\Component\Loader\PostLoaderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class PostContext extends MajoraEntityContext
{
    /**
     * @var PostCollection
     */
    protected $posts;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->posts = new PostCollection();
    }

    /**
     * @Given I have theses posts:
     */
    public function iHaveThesesPosts(PostCollection $posts)
    {
        // Fill posts table.
        foreach ($posts as $post) {
            $this->em->persist($post);
        }
        $this->em->flush();
        $this->posts = $posts;
    }

    /**
     * @Transform table:key,name
     * @Transform table:name
     */
    public function castPostsTable(TableNode $postsTable)
    {
        $posts = new PostCollection();
        foreach ($postsTable->getHash() as $postHash) {
            $post = new Post();
            $post->setName($postHash['name']);
            if (isset($postHash['key'])) {
                $posts->set($postHash['key'], $post);
                continue;
            }
            $posts->add($post);
        }

        return $posts;
    }

    /**
     * Get posts.
     *
     * @return PostCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
