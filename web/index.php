<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;

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

    // Init Twig
    $loader = new FilesystemLoader(__DIR__.'/../src/Application/Template');
    $twig = new Environment($loader, []);

    // To make an object of the controller class
    $controller_name = $request->get('controller');
    $controller = new $controller_name($twig);

    // To call the specified method of the controller class in the route
    $response = $controller->{$request->get('action')}($request, $twig);

} catch (ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Throwable $exception) {
    $response = new Response($exception->getMessage(), 500);
}

$response->send();