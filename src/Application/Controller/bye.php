<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Response;

class Bye{

    public function index() : Response {
		return $response = new Response("Goodbye");
    }

}
