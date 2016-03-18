<?php

namespace Acme\Lv\Bundle\ApiBundle\Controller\Auto;

use Acme\Lv\Bundle\ApiBundle\Form\Post\CreationType;
use Acme\Lv\Bundle\ApiBundle\Form\Post\EditionType;
use Acme\Lv\Component\Entity\Post;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for Post Rest API.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @property ContainerInterface $container
 */
trait PostApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of Posts.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function cgetAction(Request $request)
    {
        $queryFilters = array_diff_key(
            $request->query->all(),
            array_flip(array('scope', 'limit', 'offset'))
        );

        return $this->createJsonResponse(
            $this->container->get('acme.post.loader')->retrieveAll(
                $this->container->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single Post by id.
     *
     * @param int     $id      requested Post id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction($id, Request $request)
    {
        $post = $this->retrieveOr404($id, 'acme.post.loader');

        return $this->createJsonResponse(
            $post,
            $request->query->get('scope')
        );
    }

    /**
     * Creates a new Post.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function postAction(Request $request)
    {
        // submit
        $this->assertSubmitedFormIsValid($request,
            $form = $this->container->get('form.factory')->createNamed(
                '',
                CreationType::class,
                null,
                array('method' => 'POST')
            )
        );

        // resolve use case
        $post = $form->getData()->resolve();

        return $this->createJsonResponse(
            $post,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * Updates a single Post by id.
     *
     * @param int     $id      requested Post id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function putAction($id, Request $request)
    {
        // submit
        $this->assertSubmitedFormIsValid($request,
            $form = $this->container->get('form.factory')->createNamed(
                '',
                EditionType::class,
                null,
                array(
                    'method' => 'PUT',
                    'entity' => $this->retrieveOr404($id, 'acme.post.loader'),
                )
            )
        );

        // resolve use case
        $form->getData()->resolve();

        return $this->createJsonNoContentResponse();
    }

    /**
     * Delete a single Post by id.
     *
     * @param int $id requested Post id
     *
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $this->container->get('acme.post.domain')->delete(
            $this->retrieveOr404($id, 'acme.post.loader')
        );

        return $this->createJsonNoContentResponse();
    }
}
