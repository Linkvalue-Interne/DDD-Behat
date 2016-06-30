<?php

namespace Sir\Partner\Bundle\ApiBundle\Controller\Auto;

use Sir\Partner\Bundle\ApiBundle\Form\Person\CreationType;
use Sir\Partner\Bundle\ApiBundle\Form\Person\EditionType;
use Sir\Partner\Component\Entity\Person;
use Majora\Bundle\FrameworkExtraBundle\Controller\RestApiControllerTrait;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Auto generated controller for Person Rest API.
 *
 * @MajoraGenerator({"force_generation": true})
 *
 * @property ContainerInterface $container
 */
trait PersonApiControllerTrait
{
    use RestApiControllerTrait;

    /**
     * Returns a collection of Persons.
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
            $this->container->get('sir.person.loader')->retrieveAll(
                $this->container->get('majora.inflector')->normalize($queryFilters, 'camelize'),
                $request->query->get('limit'),
                $request->query->get('offset')
            ),
            $request->query->get('scope')
        );
    }

    /**
     * Returns a single Person by id.
     *
     * @param int     $id      requested Person id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAction($id, Request $request)
    {
        $person = $this->retrieveOr404($id, 'sir.person.loader');

        return $this->createJsonResponse(
            $person,
            $request->query->get('scope')
        );
    }

    /**
     * Creates a new Person.
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
        $person = $form->getData()->resolve();

        return $this->createJsonResponse(
            $person,
            $request->query->get('scope'),
            201
        );
    }

    /**
     * Updates a single Person by id.
     *
     * @param int     $id      requested Person id
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
                    'entity' => $this->retrieveOr404($id, 'sir.person.loader'),
                )
            )
        );

        // resolve use case
        $form->getData()->resolve();

        return $this->createJsonNoContentResponse();
    }

    /**
     * Delete a single Person by id.
     *
     * @param int $id requested Person id
     *
     * @return JsonResponse
     */
    public function deleteAction($id)
    {
        $this->container->get('sir.person.domain')->delete(
            $this->retrieveOr404($id, 'sir.person.loader')
        );

        return $this->createJsonNoContentResponse();
    }
}
