<?php

namespace Sir1\Partner3\Bundle\ApiBundle\Controller\Auto;

use Sir1\Partner3\Bundle\ApiBundle\Form\Person2\CreationType;
use Sir1\Partner3\Bundle\ApiBundle\Form\Person2\EditionType;
use Sir1\Partner3\Component\Entity\Person2;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for Person2 Rest API.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @property ContainerInterface $container
 */
trait Person2ApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of Person2s.
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
            $this->container->get('sir1.person2.loader')->retrieveAll(
                $this->container->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single Person2 by id.
     *
     * @param int     $id      requested Person2 id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction($id, Request $request)
    {
        $person2 = $this->retrieveOr404($id, 'sir1.person2.loader');

        return $this->createJsonResponse(
            $person2,
            $request->query->get('scope')
        );
    }

    /**
     * Creates a new Person2.
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
        $person2 = $form->getData()->resolve();

        return $this->createJsonResponse(
            $person2,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * Updates a single Person2 by id.
     *
     * @param int     $id      requested Person2 id
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
                    'entity' => $this->retrieveOr404($id, 'sir1.person2.loader'),
                )
            )
        );

        // resolve use case
        $form->getData()->resolve();

        return $this->createJsonNoContentResponse();
    }

    /**
     * Delete a single Person2 by id.
     *
     * @param int $id requested Person2 id
     *
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $this->container->get('sir1.person2.domain')->delete(
            $this->retrieveOr404($id, 'sir1.person2.loader')
        );

        return $this->createJsonNoContentResponse();
    }
}
