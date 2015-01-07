<?php

require dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;


use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

// look inside *this* directory
$locator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($locator);
$collection = $loader->load('routes.yml');

/*
$collection = new RouteCollection();
$collection->add('help', new Route('/help', array(
    'controller' => 'HelpController',
    'action' => 'indexAction'
)));
$collection->add('about', new Route('/about', array(
    'controller' => 'AboutController',
    'action' => 'indexAction'
)));
*/

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());
$matcher = new UrlMatcher($collection, $context);
print_r($matcher->match('/foo'));
