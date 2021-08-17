<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use \Twig\Loader\FilesystemLoader;
use \Twig\Environment;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

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

    // DI
    $containerBuilder = new ContainerBuilder();
    $containerBuilder->setParameter('path.root', __DIR__ . "/..");
    $loader = new YamlFileLoader($containerBuilder, new FileLocator(__DIR__));
    $loader->load(__DIR__.'/../config/dependencies.yaml');
    $containerBuilder->compile();
    $controller = $containerBuilder->get($request->get('controller'));

    // To call the specified method of the controller class in the route
    $response = $controller->{$request->get('action')}($request);

} catch (ResourceNotFoundException $exception) {
    $response = new Response('Not Found', 404);
} catch (Throwable $exception) {
    $response = new Response($exception->getMessage(), 500);
    throw $exception;
}

$response->send();