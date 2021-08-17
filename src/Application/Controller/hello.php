<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use \Twig\Environment;
use PDO;

class Hello{

	private $twig;
    protected $connection;
    protected $configuration;

	public function __construct(Environment $twig, PDO $connection) {
		$this->twig = $twig;
        $this->connection = $connection;
	}

    public function index(Request $request): Response {

    	$template = $this->twig->load('hello.html.twig');
    	$res = $template->render(['name' => $request->get('name')]);

    	$res .= "<br><br>" . "All Names:" . "<br>";

    	$sql = "select * from names";
		foreach ($this->connection->query($sql) as $row) {
		    $res .= $row['id'] . " => " . $row['name'] . "<br>";
		}

		return $response = new Response($res);
    }

}
