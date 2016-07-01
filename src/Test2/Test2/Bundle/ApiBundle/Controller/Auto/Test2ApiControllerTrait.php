<?php

namespace Test2\Test2\Bundle\ApiBundle\Controller\Auto;

use Test2\Test2\Bundle\ApiBundle\Form\Test2\CreationType;
use Test2\Test2\Bundle\ApiBundle\Form\Test2\EditionType;
use Test2\Test2\Component\Entity\Test2;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for Test2 Rest API.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @property ContainerInterface $container
 */
trait Test2ApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of Test2s.
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
            $this->container->get('test2.test2.loader')->retrieveAll(
                $this->container->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single Test2 by id.
     *
     * @param int     $id      requested Test2 id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction($id, Request $request)
    {
        $test2 = $this->retrieveOr404($id, 'test2.test2.loader');

        return $this->createJsonResponse(
            $test2,
            $request->query->get('scope')
        );
    }

    /**
     * Creates a new Test2.
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
        $test2 = $form->getData()->resolve();

        return $this->createJsonResponse(
            $test2,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * Updates a single Test2 by id.
     *
     * @param int     $id      requested Test2 id
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
                    'entity' => $this->retrieveOr404($id, 'test2.test2.loader'),
                )
            )
        );

        // resolve use case
        $form->getData()->resolve();

        return $this->createJsonNoContentResponse();
    }

    /**
     * Delete a single Test2 by id.
     *
     * @param int $id requested Test2 id
     *
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $this->container->get('test2.test2.domain')->delete(
            $this->retrieveOr404($id, 'test2.test2.loader')
        );

        return $this->createJsonNoContentResponse();
    }
}
