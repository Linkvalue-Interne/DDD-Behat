<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\TableNode;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client;
use Acme\Lv\Component\Entity\Post;
use Acme\Lv\Component\Entity\PostCollection;
use Acme\Lv\Bundle\ApiBundle\Features\Context\MajoraEntityApiContext;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Defines application features from the specific context.
 */
class PostApiControllerContext implements Context
{

    /**
    * @var UrlGeneratorInterface
    */
    protected $router;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var PostCollection
     */
    protected $posts;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(
        UrlGeneratorInterface $router,
        EntityManagerInterface $em)
    {
        $this->router = $router;
        $this->em = $em;

        $this->client = new Client();
        $this->posts = new PostCollection();
    }

    /**
     * @AfterScenario
     */
    public function removePosts()
    {
        foreach ($this->posts as $post) {
            $this->em->remove($post);
        }
        $this->em->flush();
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
                    'Wrong status code : %s given, %s expected',
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
        foreach ($posts as $post) {
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
        foreach ($posts as $post) {
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
                        'Wrong status code : %s given, %s expected',
                        $response->getStatusCode(),
                        Response::HTTP_CREATED
                    )
                );
            }

            // Parse the answer and add the created post to the postlist so we can delete it after the scenario.
            $data = (array) json_decode($response->getBody()->getContents());
            $post->denormalize($data);
            $post = $this->em->getReference('Acme\Lv\Component\Entity\Post', $post->getId());
            $this->posts->add($post);
        }
    }

    /**
     * @Given I update the :key post with theses values:
     */
    public function iUpdateTheKeyPost($key, PostCollection $posts)
    {
        $oldPost = $this->posts->get($key);

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
                        'Wrong status code : %s given, %s expected',
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
        $oldPost = $this->posts->get($key);

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
                    'Wrong status code : %s given, %s expected',
                    $response->getStatusCode(),
                    Response::HTTP_NO_CONTENT
                )
            );
        }
    }
}
