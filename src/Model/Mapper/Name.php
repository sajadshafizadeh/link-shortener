<?php

namespace Model\Mapper;

use PDO;

class Name{
	
	$this->connection = $connection;

	public function __construct(PDO $connection) {
        $this->connection = $connection;
	}	


	public function list(){

		$names = [];

		$sql = "select * from names";
		foreach ($this->connection->query($sql) as $row) {
		    $res[] = $row['name'];
		}

		return $names;
	}


}
