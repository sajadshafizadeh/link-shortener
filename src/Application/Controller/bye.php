<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Response;
use \Twig\Environment;

class Bye{

	private $twig;

	public function __construct(Environment $twig) {
		$this->twig = $twig;
	}

    public function index() : Response {

    	$template = $this->twig->load('bye.html.twig');
    	$res = $template->render();

		return $response = new Response($res);
    }

}
