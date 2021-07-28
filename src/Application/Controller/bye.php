<?php

namespace Application\Controller;

class Bye{

    public function index(){
		
		return "Goodbye";
    }

}

$obj = new Bye;
echo $obj->index();
