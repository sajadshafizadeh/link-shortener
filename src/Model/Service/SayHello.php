<?php

namespace Model\Service;

use Model\Mapper;

class SayHello{

	private $name;

	public function __construct(Mapper\Name $name) {
		$this->name = $name;
	}

	public function toNames(){

		return $this->name->list();

	}

}