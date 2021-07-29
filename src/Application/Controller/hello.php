<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Twig\Environment;

class Hello{

	private $twig;

	public function __construct(Environment $twig) {
		$this->twig = $twig;
	}

    public function index(Request $request): Response {

		return $response = new Response("Hello " . htmlspecialchars($request->get('name'), ENT_QUOTES, 'UTF-8'));
    }

}
