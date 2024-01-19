<?php

require_once '../vendor/autoload.php';
use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;
use App\BD\BD;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($views, $cache);

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

session_start();
if (isset($_SESSION['empleado'])) {
    $sesion_abierta = true;
} else {
    $sesion_abierta = false;
    header('Location: index.php');
    exit;
}
echo $blade->run('pagina_camarero', compact('sesion_abierta'));