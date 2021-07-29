<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

try {

    $parameters = $matcher->match($request->getPathInfo());

    // To set parameters to $request
    foreach ($parameters as $key => $value) {
        $request->attributes->set($key, $value);
    }

    $controller = $request->get('controller');
    $action = $request->get('action'); // method

    // extract($matcher->match($request->getPathInfo()), EXTR_SKIP);
    // ob_start();

    // To check the contoller exists
    if (class_exists($controller)){
        // To make an object of the controller class
        $controller_obj = new $controller;

        // To check the method exists
        if (method_exists($controller_obj, $action)){

            // To call the specified method of the controller class in the route
            $response = $controller_obj->$action($request);

        } else {
            throw new ResourceNotFoundException();
        }
    } else {
        throw new ResourceNotFoundException();
    } 

    // $response = new Response(ob_get_clean());

} catch (ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Exception $exception) {
    $response = new Response('An error occurred', 500);
}

$response->send();