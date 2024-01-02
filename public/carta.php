<?php

require_once '../vendor/autoload.php';
require_once 'tablas_platos.php';
use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\modelo\Plato;
use App\modelo\Stock;
use App\DAO\PlatoDAO;
use App\DAO\RestarDAO;
use App\DAO\StockDAO;
use Dotenv\Dotenv;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$views= __DIR__.'/../views';
$cache= __DIR__.'/../cache';

$blade= new BladeOne($views, $cache);



// Establece conexión a la base de datos PDO
try {
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $database = $_ENV['DB_DATABASE'];
    $usuario = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $bd = BD::getConection($host, $port, $database, $usuario, $password);
} catch (PDOException $error) {
    echo $blade->run("errorbd", compact('error'));
    exit;
}

if (isset($_SESSION['empleado'])) {
    
    $sesion_abierta = true;
} else {
    $sesion_abierta = false;
    
}

$plato1DAO= new PlatoDAO($bd);
$entrantes= $plato1DAO->buscar_por_cat('entrante');
$principales=$plato1DAO->buscar_por_cat('principal');
$postres=$plato1DAO->buscar_por_cat('postre');
$bebidas=$plato1DAO->buscar_por_cat('bebida');
$otros=$plato1DAO->buscar_por_cat('otro');

echo $blade->run('carta', compact('sesion_abierta', 'entrantes', 'principales', 'postres', 'bebidas', 'otros'));