<?php

require_once '../vendor/autoload.php';

use eftec\bladeone\BladeOne;
use App\BD\BD;
use App\DAO\EmpleadoDAO;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$views = __DIR__ . '/../views';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($views, $cache);

set_exception_handler(function ($exception) use ($blade) {
    echo $blade->run('error', compact('exception'));
    exit;
});
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
    // si la sesion esta abierta, nos tiene que redirigir a la pagina admin
    $sesion_abierta = true;
} else {
    $sesion_abierta = false;
    header('Location: index.php');
    exit;
}

$empleado = null;
$dao = new EmpleadoDAO($bd);
$empleado = $dao->selectall();
error_log(print_r($empleado, true));
echo $blade->run('pagina_de_personal', compact('sesion_abierta', 'empleado'));