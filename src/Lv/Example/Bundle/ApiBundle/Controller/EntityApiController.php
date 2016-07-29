<?php

namespace Lv\Example\Bundle\ApiBundle\Controller;

use Lv\Example\Bundle\ApiBundle\Controller\Auto\EntityApiControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for Entity entity Api actions.
 *
 * Auto generated methods :
 *
 * @method cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
 * @method getAction($id, Request $request)
 * @method postAction(Request $request)
 * @method putAction($id, Request $request)
 * @method deleteAction($id)
 */
class EntityApiController extends Controller
{
    use EntityApiControllerTrait;
}
