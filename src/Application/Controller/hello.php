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

    	$template = $this->twig->load('hello.html.twig');
    	$res = $template->render(['name' => $request->get('name')]);

		return $response = new Response($res);
    }

}
