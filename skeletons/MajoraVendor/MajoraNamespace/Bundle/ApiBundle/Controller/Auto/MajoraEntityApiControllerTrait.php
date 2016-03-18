<?php

namespace MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Controller\Auto;

use MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Form\MajoraEntity\CreationType;
use MajoraVendor\MajoraNamespace\Bundle\ApiBundle\Form\MajoraEntity\EditionType;
use MajoraVendor\MajoraNamespace\Component\Entity\MajoraEntity;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for MajoraEntity Rest API.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @property ContainerInterface $container
 */
trait MajoraEntityApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of MajoraEntitys.
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
            $this->container->get('majora_vendor.majora_entity.loader')->retrieveAll(
                $this->container->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single MajoraEntity by id.
     *
     * @param int     $id      requested MajoraEntity id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction($id, Request $request)
    {
        $majoraEntity = $this->retrieveOr404($id, 'majora_vendor.majora_entity.loader');

        return $this->createJsonResponse(
            $majoraEntity,
            $request->query->get('scope')
        );
    }

    /**
     * Creates a new MajoraEntity.
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
        $majoraEntity = $form->getData()->resolve();

        return $this->createJsonResponse(
            $majoraEntity,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * Updates a single MajoraEntity by id.
     *
     * @param int     $id      requested MajoraEntity id
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
                    'entity' => $this->retrieveOr404($id, 'majora_vendor.majora_entity.loader'),
                )
            )
        );

        // resolve use case
        $form->getData()->resolve();

        return $this->createJsonNoContentResponse();
    }

    /**
     * Delete a single MajoraEntity by id.
     *
     * @param int $id requested MajoraEntity id
     *
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $this->container->get('majora_vendor.majora_entity.domain')->delete(
            $this->retrieveOr404($id, 'majora_vendor.majora_entity.loader')
        );

        return $this->createJsonNoContentResponse();
    }
}
