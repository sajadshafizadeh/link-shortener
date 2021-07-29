<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Twig\Environment;

class Hello{

    public function index(Request $request, Environment $twig): Response {

		return $response = new Response("Hello " . htmlspecialchars($request->get('name'), ENT_QUOTES, 'UTF-8'));
    }
    
}
