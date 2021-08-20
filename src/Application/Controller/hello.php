<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Twig\Environment;
use Model\Service;

class Hello{

	private $twig;
    protected $connection;
    protected $configuration;
    private $sayHello;

	public function __construct(Environment $twig, Service\SayHello $sayHello) {
		$this->twig = $twig;
        $this->sayHello = $sayHello;
	}

    public function index(Request $request): Response {

        $names = $this->sayHello->toNames();        

    	$template = $this->twig->load('hello.html.twig');
    	$res = $template->render(['name' => $request->get('name'), 'other_names' => $names]);

		return $response = new Response($res);
    }

}
