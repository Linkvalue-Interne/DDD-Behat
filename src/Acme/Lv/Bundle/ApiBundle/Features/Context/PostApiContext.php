<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Acme\Lv\Component\Entity\PostCollection;

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
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var UrlGeneratorInterface
     */
    protected $router;

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->client = new Client();
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
        $response = $this->client->request(
            'GET',
            $this->router->generate(
                'acme_api_post_collection',
                [],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            []
        );

        if ($response->getStatusCode() != Response::HTTP_OK) {
            throw new \Exception(
                sprintf(
                    "Wrong status code : %s given, %s expected",
                    $response->getStatusCode(),
                    Response::HTTP_OK
                )
            );
        }

        $data = json_decode($response->getBody()->getContents());
        $this->postList = new PostCollection();
        $this->postList->denormalize($data);
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
            $response = $this->client->request(
                'POST',
                $this->router->generate(
                    'acme_api_post_create',
                    [],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                ['form_params' => $post->serialize()]
            );

            if ($response->getStatusCode() != Response::HTTP_CREATED) {
                throw new \Exception(
                    sprintf(
                        "Wrong status code : %s given, %s expected",
                        $response->getStatusCode(),
                        Response::HTTP_CREATED
                    )
                );
            }
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
            $response = $this->client->request(
                'PUT',
                $this->router->generate(
                    'acme_api_post_update',
                    ['id' => $oldPost->getId()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                ['form_params' => $post->serialize()]
            );

            if ($response->getStatusCode() != Response::HTTP_NO_CONTENT) {
                throw new \Exception(
                    sprintf(
                        "Wrong status code : %s given, %s expected",
                        $response->getStatusCode(),
                        Response::HTTP_NO_CONTENT
                    )
                );
            }
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

        $response = $this->client->request(
            'DELETE',
            $this->router->generate(
                'acme_api_post_delete',
                ['id' => $oldPost->getId()],
                UrlGeneratorInterface::ABSOLUTE_URL
            ),
            []
        );

        if ($response->getStatusCode() != Response::HTTP_NO_CONTENT) {
            throw new \Exception(
                sprintf(
                    "Wrong status code : %s given, %s expected",
                    $response->getStatusCode(),
                    Response::HTTP_NO_CONTENT
                )
            );
        }
    }
}
