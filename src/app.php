<?php

use Symfony\Component\Routing;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\YamlFileLoader;


$routes = new Routing\RouteCollection();
$routes->add('hello', new Routing\Route('/hello/{name}', ['name' => 'World']));
$routes->add('bye', new Routing\Route('/bye'));


$fileLocator = new FileLocator([__DIR__]);
$loader = new YamlFileLoader($fileLocator);
$routes .= $loader->load('routes.yaml');

return $routes;