<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Entity\PostCollection;
use Acme\Lv\Component\Repository\PostRepositoryInterface;
use Acme\Lv\Component\Loader\PostLoaderInterface;

/**
 * Defines application features from the specific context.
 */
class PostContext implements Context
{
    /**
     * @var PostCollection
     */
    protected $posts;

    /**
     * @var PostRepositoryInterface
     */
    protected $repository;

    /**
     * @var PostLoaderInterface
     */
    protected $loader;

    public function __construct(
        PostRepositoryInterface $repository,
        PostLoaderInterface $loader)
    {
        $this->repository = $repository;
        $this->loader = $loader;
        $this->posts = new PostCollection();
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
     * @Given I have theses posts:
     */
    public function iHaveThesesPosts(PostCollection $posts)
    {
        // Flush posts table.
        $oldPosts = $this->loader->retrieveAll();
        foreach ($oldPosts as $oldPost){
            $this->repository->remove($oldPost);
        }

        // Fill posts table.
        foreach ($posts as $post) {
            $this->repository->persist($post);
        }
        $this->posts = $posts;
    }

    /**
     * Bootstrap test database.
     *
     * @BeforeFeature
     */
    public static function initBdd()
    {
        exec('php app/console --env=test doctrine:schema:drop --force');
        exec('php app/console --env=test doctrine:schema:create');
        // No use of fixtures, loaded in background.
        // exec('php app/console --env=test doctrine:fixtures:load --no-interaction');
        echo 'Bdd initialized';
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
