<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;

/**
 * Defines application features from the specific context.
 */
class PostApiContext implements Context
{
	/**
	 * @var PostContext
	 */
	protected $postContext;

	/**
	 * @var Client
	 */
	protected $client;

	/**
	 * @var Router
	 */
	protected $router;

    public function __construct($client, $router)
    {
        $this->client = $client;
        $this->router = $router;
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
    	// $client->get($router->get...);
        $this->postList = $this->loader->retrieveAll();
    }

    /**
     * @Then I should see theses posts:
     * @Then I should see this post:
     */
    public function iShouldSeeThesesPosts(PostCollection $posts)
    {
        foreach ($posts as $post){
            if (!$this->postList->search(['name' => $post->getName()])->count()) {
                $postName = $post->getName();
                throw new \Exception("The post $postName was not found.");
            }
        }
    }

    /**
     * @Then I should not see theses posts:
     * @Then I should not see this post:
     */
    public function iShouldNotSeeThesesPosts(PostCollection $posts)
    {
        foreach ($posts as $post){
            if ($this->postList->search(['name' => $post->getName()])->count()) {
                $postName = $post->getName();
                throw new \Exception("The post $postName was found.");
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
        	// $this->client->post($router->...)
            // $this->domain->create($post->serialize());
        }
    }

    /**
     * @Given I update the :key post with theses values:
     */
    public function iUpdateTheKeyPost($key, PostCollection $posts)
    {
        $oldPost = $this->postContext->getPosts()->get($key);

        if (!$oldPost) {
            throw new \Exception("The post \"$key\" was not found.");
        }

        foreach ($posts as $post) {
        	// $this->client->put($router->...)
            // $this->domain->update($oldPost, $post->serialize());
        }
    }

    /**
     * @Given I delete the :key post
     */
    public function iDeleteTheKeyPost($key)
    {
        $oldPost = $this->postContext->getPosts()->get($key);

        if (!$oldPost) {
            throw new \Exception("The post \"$key\" was not found.");
        }

        // $this->client->delete($router->...)
        // $this->domain->delete($oldPost);
        
    }
}
