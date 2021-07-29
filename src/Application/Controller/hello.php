<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Hello{

    public function index(Request $request){
		return $response = new Response("Hello " . htmlspecialchars($request->get('name'), ENT_QUOTES, 'UTF-8'));
    }

}
