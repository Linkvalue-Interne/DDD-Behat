<?php

namespace Lv\Example\Bundle\ApiBundle\Controller\Auto;

use Lv\Example\Bundle\ApiBundle\Form\Entity\CreationType;
use Lv\Example\Bundle\ApiBundle\Form\Entity\EditionType;
use Lv\Example\Component\Entity\Entity;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for Entity Rest API.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @property ContainerInterface $container
 */
trait EntityApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of Entitys.
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
            $this->container->get('lv.entity.loader')->retrieveAll(
                $this->container->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single Entity by id.
     *
     * @param int     $id      requested Entity id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction($id, Request $request)
    {
        $entity = $this->retrieveOr404($id, 'lv.entity.loader');

        return $this->createJsonResponse(
            $entity,
            $request->query->get('scope')
        );
    }

    /**
     * Creates a new Entity.
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
        $entity = $form->getData()->resolve();

        return $this->createJsonResponse(
            $entity,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * Updates a single Entity by id.
     *
     * @param int     $id      requested Entity id
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
                    'entity' => $this->retrieveOr404($id, 'lv.entity.loader'),
                )
            )
        );

        // resolve use case
        $form->getData()->resolve();

        return $this->createJsonNoContentResponse();
    }

    /**
     * Delete a single Entity by id.
     *
     * @param int $id requested Entity id
     *
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $this->container->get('lv.entity.domain')->delete(
            $this->retrieveOr404($id, 'lv.entity.loader')
        );

        return $this->createJsonNoContentResponse();
    }
}
