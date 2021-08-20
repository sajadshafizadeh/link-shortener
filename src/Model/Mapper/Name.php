<?php

namespace Model\Mapper;

use PDO;

class Name{
	
	private $connection;

	public function __construct(PDO $connection) {
        $this->connection = $connection;
	}	


	public function list(){

		$names = [];

		$sql = "select * from names";
		foreach ($this->connection->query($sql) as $row) {
		    $names[] = $row['name'];
		}

		return $names;
	}


}
