<?php

namespace Sir\Partner\Bundle\ApiBundle\Controller;

use Sir\Partner\Bundle\ApiBundle\Controller\Auto\PersonApiControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for Person entity Api actions.
 *
 * Auto generated methods :
 *
 * @method cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
 * @method getAction($id, Request $request)
 * @method postAction(Request $request)
 * @method putAction($id, Request $request)
 * @method deleteAction($id)
 */
class PersonApiController extends Controller
{
    use PersonApiControllerTrait;
}
