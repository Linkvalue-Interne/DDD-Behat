<?php

namespace Acme\Lv\Bundle\ApiBundle\Controller;

use Acme\Lv\Bundle\ApiBundle\Controller\Auto\PostApiControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Controller for Post entity Api actions.
 *
 * Auto generated methods :
 *
 * @method cgetAction(ParamFetcherInterface $paramFetcher, Request $request)
 * @method getAction($id, Request $request)
 * @method postAction(Request $request)
 * @method putAction($id, Request $request)
 * @method deleteAction($id)
 */
class PostApiController extends Controller
{
    use PostApiControllerTrait;
}
