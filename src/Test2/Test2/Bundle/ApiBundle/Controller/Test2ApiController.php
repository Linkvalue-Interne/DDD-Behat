<?php

namespace Test2\Test2\Bundle\ApiBundle\Controller;

use Test2\Test2\Bundle\ApiBundle\Controller\Auto\Test2ApiControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for Test2 entity Api actions.
 *
 * Auto generated methods :
 *
 * @method cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
 * @method getAction($id, Request $request)
 * @method postAction(Request $request)
 * @method putAction($id, Request $request)
 * @method deleteAction($id)
 */
class Test2ApiController extends Controller
{
    use Test2ApiControllerTrait;
}
