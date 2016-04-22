<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Gherkin\Node\TableNode;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Entity\PostCollection;
use Acme\Lv\Component\Domain\PostDomainInterface;
use Acme\Lv\Component\Loader\PostLoaderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class PostDalDomainContext extends MajoraEntityDalContext
{
    /**
     * @var PostDomainInterface
     */
    protected $domain;

    /**
     * @var PostLoaderInterface
     */
    protected $loader;

    /**
     * @var PostCollection
     */
    protected $posts;

    public function __construct(
        PostDomainInterface $domain,
        PostLoaderInterface $loader,
        EntityManagerInterface $em)
    {
        parent::__construct($em);

        $this->domain = $domain;
        $this->loader = $loader;
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
     * @Given I get the post list
     */
    public function iGetThePostList()
    {
        $this->postList = $this->loader->retrieveAll();
    }

    /**
     * @Then I should see theses posts:
     * @Then I should see this post:
     */
    public function iShouldSeeThesesPosts(PostCollection $posts)
    {
        foreach ($posts as $post) {
            if (!$this->postList->search(['name' => $post->getName()])->count()) {
                $postName = $post->getName();
                throw new \Exception(sprintf('The post %s was not found.', $postName));
            }
        }
    }

    /**
     * @Then I should not see theses posts:
     * @Then I should not see this post:
     */
    public function iShouldNotSeeThesesPosts(PostCollection $posts)
    {
        foreach ($posts as $post) {
            if ($this->postList->search(['name' => $post->getName()])->count()) {
                $postName = $post->getName();
                throw new \Exception(sprintf('The post %s was found.', $postName));
            }
        }
    }

    /**
     * @Given I create this post:
     * @Given I create theses posts:
     */
    public function iCreateThisPost(PostCollection $posts)
    {
        foreach ($posts as $post) {
            $this->domain->create($post->serialize());
        }
    }

    /**
     * @Given I update the :key post with theses values:
     */
    public function iUpdateTheKeyPost($key, PostCollection $posts)
    {
        $oldPost = $this->posts->get($key);

        if (!$oldPost) {
            throw new \Exception(sprintf('The post %s was not found.', $key));
        }

        foreach ($posts as $post) {
            $this->domain->update($oldPost, $post->serialize());
        }
    }

    /**
     * @Given I delete the :key post
     */
    public function iDeleteTheKeyPost($key)
    {
        $oldPost = $this->posts->get($key);

        if (!$oldPost) {
            throw new \Exception(sprintf('The post %s was not found.', $key));
        }

        $this->domain->delete($oldPost);
    }
}
