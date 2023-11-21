<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\BD\BD;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// Inicializa el acceso a las variables de entorno

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);


$test = "Hola Crunchy!";
echo $blade->run("principal", compact('test'));
