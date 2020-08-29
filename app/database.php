<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection([
	'driver' => 'mysql',
	'host' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'pt14315-web-assignment'
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();
