<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Acme\Lv\Component\Entity\PostCollection;
use Acme\Lv\Component\Domain\PostDomainInterface;
use Acme\Lv\Component\Loader\PostLoaderInterface;

/**
 * Defines application features from the specific context.
 */
class PostDomainContext implements Context
{
    /**
     * @var PostContext
     */
    protected $postContext;

    /**
     * @var PostDomainInterface
     */
    protected $domain;

    /**
     * @var PostLoaderInterface
     */
    protected $loader;

    public function __construct(
        PostDomainInterface $domain,
        PostLoaderInterface $loader)
    {
        $this->domain = $domain;
        $this->loader = $loader;
    }

    /**
     * Get Fixtures post from main context.
     *
     * @BeforeScenario
     */
    public function gatherContexts(BeforeScenarioScope $scope)
    {
        $environment = $scope->getEnvironment();

        $this->postContext = $environment
                        ->getContext('Acme\Lv\Bundle\ApiBundle\Features\Context\PostContext');
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
        $oldPost = $this->postContext->getPosts()->get($key);

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
        $oldPost = $this->postContext->getPosts()->get($key);

        if (!$oldPost) {
            throw new \Exception(sprintf('The post %s was not found.', $key));
        }

        $this->domain->delete($oldPost);
    }
}
