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
class PostContext implements Context
{

    /**
     * @var PostLoaderInterface
     */
    protected $loader;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var PostCollection
     */
    protected $posts;

    public function __construct(
        EntityManagerInterface $em,
        PostLoaderInterface $loader)
    {
        $this->em = $em;
        $this->loader = $loader;

        $this->posts = new PostCollection();
    }

    /**
     * @BeforeSuite
     */
    public static function initDabatabase()
    {
        exec('php app/console --env=test doctrine:schema:drop --force');
        exec('php app/console --env=test doctrine:schema:create');
        // No use of fixtures, loaded in background.
        // exec('php app/console --env=test doctrine:fixtures:load --no-interaction');
        echo 'Bdd initialized';
    }

    /**
     * @BeforeScenario @Post
     */
    public function BeforeScenarioPost()
    {
        $this->em->getConnection();
        $this->em->beginTransaction();
    }

    /**
     * @AfterScenario @Post
     */
    public function AfterScenarioPost()
    {
        $this->em->rollback();
        $this->em->close();
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
