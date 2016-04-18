<?php

namespace Acme\Lv\Bundle\ApiBundle\Features\Context;

use Behat\Behat\Context\Context;
use Symfony\Component\Routing\RouterInterface;

class PostRouterContext implements Context
{
    public function __construct(
        RouterInterface $router,
        $host = 'localhost',
        $scheme = 'http',
        $baseUrl = '',
        $port = '80')
    {
        $context = $router->getContext();
        $context->setHost($host);
        $context->setScheme($scheme);
        $context->setBaseUrl($baseUrl);
        $setPortMethodName = 'set' . ucfirst($scheme) . 'Port';
        $context->$setPortMethodName($port);
    }
}
