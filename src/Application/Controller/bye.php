<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Response;

class Bye{

    public function index(){
		return $response = new Response("Goodbye");
    }

}
