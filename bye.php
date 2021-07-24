<?php 

require_once __DIR__.'/bootstrap.php';

$response->setContent('Goodbye!');
$response->send();