<?php

namespace Application\Controller;

use Symfony\Component\HttpFoundation\Response;

class Hello{

    public function index($params){
		return $response = new Response("Hello " . htmlspecialchars($params['name'], ENT_QUOTES, 'UTF-8'));
    }

}
